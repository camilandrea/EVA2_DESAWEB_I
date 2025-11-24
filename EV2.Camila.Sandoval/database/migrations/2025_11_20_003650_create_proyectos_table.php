<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id(); // ID del proyecto
            $table->string('nombre'); // Nombre del proyecto
            $table->date('fecha_inicio'); // Fecha de inicio
            $table->string('estado'); // Estado
            $table->string('responsable'); // Responsable
            $table->decimal('monto', 10, 2); // Monto
            $table->foreignId('creado_por')->constrained('users'); // ID del usuario que creó el proyecto
            $table->timestamps(); // Timestamps para las fechas de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
