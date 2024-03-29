<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_statuses = [
            'новый',
            'в работе',
            'на тестировании',
            'завершен'
        ];
        foreach ($default_statuses as $status) {
            DB::table('task_statuses')->insert([
                'name' => $status
            ]);
        }
    }
}
