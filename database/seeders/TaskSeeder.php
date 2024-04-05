<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Yaml::parseFile(database_path('fixtures/tasks.yml'));

        Task::factory(count($tasks))
            ->sequence(...$tasks)
            ->create();

        Task::all()->each(function ($task) {
            $labels = Label::inRandomOrder()
                ->limit(rand(1, min(3, Label::count())))
                ->get();

            $task->labels()->attach($labels);
        });
    }
}
