<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'summary', 'slug', 'client_name', 'cover_image', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // Laravel si aspetterebbe una tabella pivot(ponte) chiamata project_technology (ordine alfabetico dei nomi dei modelli al singolare)
    //  e colonne chiamate project_id e technology_id. Tuttavia, poiché la tabella pivot non segue questa convenzione (si chiama projects_technologies),
    //  è necessario specificare questi parametri manualmente per dire a Laravel come trovare le informazioni corrette.
    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'projects_technologies');
    }
}

// return $this->belongsTo(Type::class);: Indica che il modello corrente ha una relazione di tipo "belongsTo" 
// con il modello Type. Questo significa che ogni istanza del modello corrente è associata a un'istanza del modello Type. 
// In altre parole, questo modello contiene una chiave esterna che punta alla tabella types (o a qualunque tabella sia associata al modello Type).


// casi d'uso
// $project = Project::find(1); // Trova il progetto con ID 1
// $type = $project->type; // Ottiene l'oggetto Type associato al progetto
// echo $type->name; // Stampa il nome del tipo
