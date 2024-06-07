<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProjectsTableSeeder;
use Database\Seeders\TipeTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Quando esegui il comando php artisan db:seed in Laravel, il framework eseguirà questo file, che a sua volta eseguirà i seeder elencati,
        // Questo metodo viene utilizzato per eseguire i seeder specificati. I seeder sono script che popolano il database con dati di esempio o iniziali
        //il primo Indica il seeder della tabella projects
        //il secondo Indica il seeder della tabella types

        $this->call([
            ProjectsTableSeeder::class,
            TipeTableSeeder::class,
            TechnologiesTableSeeder::class
        ]);
    }
}                      
