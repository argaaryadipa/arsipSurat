<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_instansi', function (Blueprint $table) {
            $table->id('id_instansi');
            $table->string('nama_instansi',250);
            $table->string('jenjang_instansi',250);
            $table->bigInteger('npsn');
            $table->text('alamat_instansi');
            $table->string('name_file')->nullable();
            $table->string('file')->nullable();
            $table->string('extension')->nullable();
            $table->integer('size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_instansi');
    }
};
