<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            [
                'title' => 'Review weekly priorities',
                'description' => 'Check the upcoming tasks and confirm the most important items.',
                'due_date' => now()->toDateString(),
                'status' => 'pending',
            ],
            [
                'title' => 'Prepare project notes',
                'description' => 'Organize notes and share the latest project update.',
                'due_date' => now()->addDay()->toDateString(),
                'status' => 'in_progress',
            ],
            [
                'title' => 'Set up the task workspace',
                'description' => 'Create the initial task list and verify the workflow.',
                'due_date' => now()->toDateString(),
                'status' => 'done',
            ],
        ] as $task) {
            Task::firstOrCreate(['title' => $task['title']], $task);
        }
    }
}
