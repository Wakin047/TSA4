<?php

namespace Tests\Feature;

use App\Mail\TaskCompletedMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    public function test_authenticated_user_can_view_archived_tasks_without_active_tasks(): void
    {
        $this->actingAs(User::factory()->create());

        $archived = Task::create([
            'title' => 'Archived task to review',
            'status' => 'pending',
        ]);
        $archived->is_archived = true;
        $archived->save();
        Task::create([
            'title' => 'Active task to keep separate',
            'status' => 'pending',
        ]);

        $this->get(route('tasks.index'))
            ->assertOk()
            ->assertSee(route('tasks.archived'), false);

        $this->get(route('tasks.archived'))
            ->assertOk()
            ->assertSeeText($archived->title)
            ->assertSeeText('Archived')
            ->assertDontSeeText('Active task to keep separate');
    }

    public function test_guests_cannot_open_task_management_forms(): void
    {
        $task = Task::create([
            'title' => 'Protected task',
            'status' => 'pending',
        ]);

        $this->get(route('tasks.create'))->assertRedirect(route('login'));
        $this->get(route('tasks.archived'))->assertRedirect(route('login'));
        $this->post(route('tasks.store'), [])->assertRedirect(route('login'));
        $this->get(route('tasks.edit', $task))->assertRedirect(route('login'));
        $this->put(route('tasks.update', $task), ['status' => 'done'])->assertRedirect(route('login'));
        $this->delete(route('tasks.destroy', $task))->assertRedirect(route('login'));
        $this->delete(route('tasks.delete', $task))->assertRedirect(route('login'));

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
        ])->assertRedirect(route('profile.edit'))
            ->assertSessionHas('status', 'Profile updated successfully!');

        $this->get(route('profile.edit'))
            ->assertSeeText('Profile updated successfully!')
            ->assertSee('class="alert alert-success"', false);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'full_name' => 'Updated Name',
            'username' => 'updated-username',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_authenticated_user_can_upload_and_replace_profile_photo(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $oldAvatarPath = UploadedFile::fake()->image('old-avatar.jpg')->store('avatars', 'public');
        $user->update(['avatar_path' => $oldAvatarPath]);
        $this->actingAs($user);

        $newAvatar = UploadedFile::fake()->image('new-avatar.png');

        $this->patch(route('profile.update'), [
            'full_name' => $user->full_name,
            'username' => $user->username,
            'email' => $user->email,
            'avatar' => $newAvatar,
        ])->assertRedirect(route('profile.edit'));

        $user->refresh();
        $this->assertNotSame($oldAvatarPath, $user->avatar_path);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'avatar_path' => $user->avatar_path,
        ]);
        Storage::disk('public')->assertExists($user->avatar_path);
        Storage::disk('public')->assertMissing($oldAvatarPath);
    }

    public function test_deleting_account_removes_its_profile_photo(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $avatarPath = UploadedFile::fake()->image('avatar.jpg')->store('avatars', 'public');
        $user->update(['avatar_path' => $avatarPath]);

        $this->actingAs($user)
            ->delete(route('profile.destroy'), ['password' => 'password'])
            ->assertRedirect('/');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        Storage::disk('public')->assertMissing($avatarPath);
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

    public function test_authenticated_user_can_permanently_delete_a_task(): void
    {
        $this->actingAs(User::factory()->create());
        $task = Task::create([
            'title' => 'Remove obsolete task',
            'status' => 'pending',
        ]);

        $this->get(route('tasks.index'))
            ->assertOk()
            ->assertSee('Edit')
            ->assertSee('Archive')
            ->assertSee('Delete');

        $this->delete(route('tasks.delete', $task))
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHas('status', 'Task permanently deleted.');

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
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
        ])->assertRedirect(route('tasks.index'))
            ->assertSessionHas('status', 'Task updated successfully.');

        $this->get(route('tasks.index'))
            ->assertOk()
            ->assertSee('Task updated successfully.')
            ->assertSee('class="alert alert-success"', false);

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
