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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50);
            $table->string('kode_barang',20)->unique();
            $table->unsignedInteger('id_user')
                ->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_satuan')
                ->foreign('id_satuan')->references('id')->on('satuans')->onDelete('cascade');
            $table->unsignedInteger('id_kategori')
                ->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
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
        Schema::dropIfExists('barangs');
    }
};
