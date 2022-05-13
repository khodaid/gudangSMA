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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pembukuan');
            $table->string('kode',10);
            $table->unsignedInteger('id_barang')
                ->foreign('id_barang')->refrences('id')->on('barangs')->onDelete('cascade');
            $table->string('deskripsi',50);
            $table->integer('jumlah');
            $table->unsignedInteger('id_satuan')
                ->foreign('id_satuan')->refrences('id')->on('satuans')->onDelete('cascade');
            $table->string('thn_pembuatan',4);
            $table->unsignedInteger('id_dana')
                ->foreign('id_dana')->refrences('id')->on('danas')->onDelete('cascade');
            $table->unsignedInteger('id_user')
                ->foreign('id_user')->refrences('id')->on('users')->onDelete('cascade');
            $table->date('tgl_penyerahan');
            $table->integer('kondisi');
            $table->integer('harga');
            $table->integer('hrg_total');
            $table->string('file',50);
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
        Schema::dropIfExists('inventaris');
    }
};
