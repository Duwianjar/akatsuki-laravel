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
        Schema::create('sampah_users', function (Blueprint $table) {
            $table->id();
            $table->integer('id_users');
            $table->string('name');
            $table->text('fullname');
            $table->char('telepon');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            $table->text('google_id');
            $table->string('role');
            $table->integer('id_penghapus');
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->cascadeOnUpdate();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};