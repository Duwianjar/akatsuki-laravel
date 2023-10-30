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
        Schema::create('sampah_mapel', function (Blueprint $table) {
            $table->id();
            $table->integer('id_mapel');
            $table->string('namamapel');
            $table->foreignId('id_guru')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->cascadeOnUpdate();
            $table->string('deskripsi');
            $table->integer('id_penghapus');
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
        //
    }
};