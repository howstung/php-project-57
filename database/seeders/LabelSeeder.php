<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = Yaml::parseFile(database_path('fixtures/labels.yml'));
        Label::factory(count($labels))
            ->state(new Sequence(...$labels))
            ->create();
    }
}
