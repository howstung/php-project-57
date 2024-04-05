<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $task_statuses = Yaml::parseFile(database_path('fixtures/task_statuses.yml'));
        TaskStatus::factory(count($task_statuses))
            ->state(new Sequence(...$task_statuses))
            ->create();
    }
}
