<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_paciente');
            $table->integer('id_planta');
            $table->integer('id_area');
            $table->string('turno_pac',1);            
            $table->date('fecha_accidente');            
            $table->date('fecha_acude');            
            $table->string('atendio_pac',4);
            $table->string('tipo_riesgo_acc',3);
            $table->string('supervisor_pac',70);
            $table->integer('id_parte_cuerpo');
            $table->integer('id_diagn');
            $table->string('incapacidad_aplica',1);  
            $table->string('observacion_diag',200);  
            
            $table->integer('user_reg');  
            $table->integer('user_update');  

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accidente');
    }
}
