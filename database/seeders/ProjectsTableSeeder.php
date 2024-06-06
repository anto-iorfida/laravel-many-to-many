<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 16; $i++){
            $newProject = new Project();
            $newProject->name = $faker->sentence(3);
            $newProject->slug = Str::slug($newProject->name,'-');
            $newProject->client_name = $faker->name;
            $newProject->summary = $faker->text(400);
            $newProject->save();
        }
    }
}
