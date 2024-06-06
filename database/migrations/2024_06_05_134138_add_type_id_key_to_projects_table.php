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
        Schema::table('projects', function (Blueprint $table) {
            // colonna type_id da aggiungere
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            $table->foreign('type_id')
            //questa foreign, specificare colonna della tabella a che fa riferimento
            ->references('id')
            //specificare tabella di riferimento
            ->on('types')
            // se una categoria viene cancellata mette null al posto di cancellare tutte le righe della categoria
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // nome tabella _nome del campo tipo di foreign _ foreign  (leva la foreign) 
            // cosi si cancella la regola con il rollaback
            $table->dropForeign('projects_type_id_foreign');
            // toglie colonna
            $table->dropColumn('type_id');
        });
    }
};
