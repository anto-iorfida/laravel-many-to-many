<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ["software","edilizio","scientifico","marketing","aziendale"];
        // per ogni typo creo nuova istanza di type la popolo e la salvo
        foreach ($types as $typeName){

            $newType = new Type();
            $newType->name = $typeName;
            $newType->slug = Str::slug($newType->name, '-');
            $newType->save();

        }
    }
}
