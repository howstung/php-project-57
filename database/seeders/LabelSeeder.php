<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $labels = [
            'простая' => 'Простая задача',
            'средняя' => 'Задача среднего уровня',
            'сложная' => 'Сложная задача',
            'очень сложная задача' => 'Очень сложная задача',

            'ошибка' => 'Какая-то ошибка в коде или проблема с функциональностью',
            'документация' => 'Задача по документации',
            'доработка' => 'Новая фича, которую нужно запилить',

            'Front-end' => 'Задача для фронта',
            'Back-end' => 'Задача для бэка',
            'Devops' => 'Задача для девопса',
            'Design' => 'Задача для дизайнера',

            'срочно' => 'Очень срочная задача',
            'на особом контроле' => 'Задача на особом контроле',
        ];
        foreach ($labels as $name => $description) {
            DB::table('labels')->insert([
                'name' => $name,
                'description' => $description,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
