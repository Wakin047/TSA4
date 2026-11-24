<?php

namespace Tests\Feature;

use App\Mail\TaskCompletedMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_list_is_public_and_hides_archived_tasks(): void
    {
        $active = Task::create([
            'title' => 'Visible task',
            'status' => 'pending',
        ]);
        $archived = Task::create([
            'title' => 'Hidden archived record',
            'status' => 'pending',
        ]);
        $archived->is_archived = true;
        $archived->save();

        $this->get(route('home'))->assertOk();
        $this->get(route('about'))->assertOk();
        $this->get(route('profile.public'))->assertOk();

        $this->get(route('tasks.index'))
            ->assertOk()
            ->assertSee($active->title)
            ->assertDontSee($archived->title);
    }

    public function test_guests_cannot_open_task_management_forms(): void
    {
        $task = Task::create([
            'title' => 'Protected task',
            'status' => 'pending',
        ]);

        $this->get(route('tasks.create'))->assertRedirect(route('login'));
        $this->post(route('tasks.store'), [])->assertRedirect(route('login'));
        $this->get(route('tasks.edit', $task))->assertRedirect(route('login'));
        $this->put(route('tasks.update', $task), ['status' => 'done'])->assertRedirect(route('login'));
        $this->delete(route('tasks.destroy', $task))->assertRedirect(route('login'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_archived' => false,
            'status' => 'pending',
        ]);
    }

    public function test_authenticated_user_can_open_profile_settings(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('profile.edit'))
            ->assertOk()
            ->assertSeeText('Profile Information')
            ->assertSeeText('Update Password')
            ->assertSeeText('Delete Account')
            ->assertSee('profile-settings-grid', false)
            ->assertSee('name="full_name"', false)
            ->assertSee('name="username"', false);
    }

    public function test_authenticated_user_can_update_profile_information(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patch(route('profile.update'), [
            'full_name' => 'Updated Name',
            'username' => 'updated-username',
            'email' => 'updated@example.com',
        ])->assertRedirect(route('profile.edit'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'full_name' => 'Updated Name',
            'username' => 'updated-username',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_authenticated_user_can_create_and_archive_a_task(): void
    {
        $this->actingAs(User::factory()->create());

        $this->from(route('tasks.create'))
            ->post(route('tasks.store'), ['status' => 'pending'])
            ->assertSessionHasErrors(['title']);

        $this->post(route('tasks.store'), [
            'title' => 'Write assessment',
            'description' => 'Complete the task management assessment.',
            'due_date' => '2026-11-25',
            'status' => 'pending',
        ])->assertRedirect(route('tasks.index'));

        $task = Task::where('title', 'Write assessment')->firstOrFail();
        $this->assertFalse($task->is_archived);

        $this->delete(route('tasks.destroy', $task))
            ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_archived' => true,
        ]);
    }

    public function test_completion_email_is_sent_once_per_transition_to_done(): void
    {
        Mail::fake();
        $this->actingAs(User::factory()->create());
        $task = Task::create([
            'title' => 'Finish assessment',
            'status' => 'pending',
        ]);

        $this->put(route('tasks.update', $task), [
            'title' => $task->title,
            'description' => '',
            'due_date' => '',
            'status' => 'done',
        ])->assertRedirect(route('tasks.index'));

        Mail::assertSent(TaskCompletedMail::class, function (TaskCompletedMail $mail): bool {
            return $mail->hasTo(config('mail.task_notification_recipient'));
        });
        Mail::assertSent(TaskCompletedMail::class, 1);

        $task->refresh();
        $this->put(route('tasks.update', $task), [
            'title' => $task->title,
            'description' => '',
            'due_date' => '',
            'status' => 'done',
        ])->assertRedirect(route('tasks.index'));

        Mail::assertSent(TaskCompletedMail::class, 1);
    }
}
