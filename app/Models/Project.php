<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'summary', 'slug','client_name','cover_image','type_id'];

    public function type(){
        return $this->belongsTo(Type::class);
    }
}

// return $this->belongsTo(Type::class);: Indica che il modello corrente ha una relazione di tipo "belongsTo" 
// con il modello Type. Questo significa che ogni istanza del modello corrente è associata a un'istanza del modello Type. 
// In altre parole, questo modello contiene una chiave esterna che punta alla tabella types (o a qualunque tabella sia associata al modello Type).


// casi d'uso
// $project = Project::find(1); // Trova il progetto con ID 1
// $type = $project->type; // Ottiene l'oggetto Type associato al progetto
// echo $type->name; // Stampa il nome del tipo
