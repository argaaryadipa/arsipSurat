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
        Schema::create('table_user_instansi', function (Blueprint $table) {
            $table->id('id_user_instansi');
            $table->bigInteger('id_instansi')->unsigned();
            $table->string('email')->unique();
            $table->timestamps();

            $table->foreign('id_instansi')->references('id_instansi')
            ->on('table_instansi')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_user_instansi');
    }
};
