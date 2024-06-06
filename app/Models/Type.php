<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

// return $this->hasMany(Project::class);: Indica che il modello corrente ha una relazione di tipo "hasMany" 
// con il modello Project. Questo significa che ogni istanza del modello corrente può essere associata a più istanze del modello Project.



