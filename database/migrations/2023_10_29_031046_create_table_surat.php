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
        Schema::create('table_surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->bigInteger('id_keterangan')->unsigned();
            $table->enum('jenis_surat', ['Masuk','Keluar']);
            $table->string('name_file');
            $table->string('file');
            $table->string('extension');
            $table->integer('size');
            $table->text('perihal');
            $table->char('kode_surat');
            $table->timestamps();

            $table->foreign('id_keterangan')->references('id_keterangan')
            ->on('table_keterangan')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_surat');
    }
};
