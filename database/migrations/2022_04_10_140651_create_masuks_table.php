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
        Schema::create('masuks', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi',100);
            $table->integer('jumlah');
            $table->date('tgl_pemesanan');
            $table->string('nama_toko',100)->nullable();
            $table->date('tgl_penerimaan');
            $table->integer('harga_satuan');
            $table->integer('jumlah_harga');
            $table->unsignedInteger('id_satuan')
                ->foreign('id_satuan')->references('id')->on('satuans')->onDelete('cascade');
            $table->unsignedInteger('id_user')
                ->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_barang')
                ->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');

            $table->string('file',100);
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
        Schema::dropIfExists('masuks');
    }
};
