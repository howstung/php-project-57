<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = require __DIR__ . "/tasks_for_seeder.php";

        foreach ($tasks as $data) {
            $labels = array_pop($data);

            $task = new Task();
            $task->fill($data);
            $task->save();

            $LabelsObjects = [];
            foreach ($labels as $label) {
                $LabelsObjects[] = Label::findOrFail($label);
            }
            $task->labels()->saveMany($LabelsObjects);
        }
    }
}
