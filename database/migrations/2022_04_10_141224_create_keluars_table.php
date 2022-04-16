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
        Schema::create('keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_keluar');
            $table->string('deskripsi',100);
            $table->integer('jumlah');
            $table->unsignedInteger('id_barang')
                ->foreign('id_barang')->refrences('id')->on('barangs')->onDelete('cascade');
            $table->unsignedInteger('id_userg')
                ->foreign('id_user')->refrences('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_satuan')
                ->foreign('id_satuan')->refrences('id')->on('satuans')->onDelete('cascade');
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
        Schema::dropIfExists('keluars');
    }
};
