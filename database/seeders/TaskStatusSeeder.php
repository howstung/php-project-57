<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $default_statuses = [
            'новый',
            'в работе',
            'на тестировании',
            'завершен',

            'в архиве'
        ];
        foreach ($default_statuses as $status) {
            DB::table('task_statuses')->insert([
                'name' => $status,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}
