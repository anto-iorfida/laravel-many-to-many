<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_technologies', function (Blueprint $table) {
           // colonna project_id da aggiungere
           $table->unsignedBigInteger('project_id');

           $table->foreign('project_id')
           //questa foreign, specificare colonna della tabella a che fa riferimento
           ->references('id')
           //specificare tabella di riferimento
           ->on('projects')
           //specifica che, quando un record nella tabella padre viene eliminato, tutti i record associati nella tabella figlio verranno automaticamente eliminati.
           ->onDelete('cascade');
            // ??
           $table->primary('project_id','technology_id');


           $table->unsignedBigInteger('technology_id');
           $table->foreign('technology_id')
           ->references('id')
           ->on('technologies')
           ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_technologies');
    }
};
