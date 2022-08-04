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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nomer_pengaduan');
            $table->string('name');
            $table->string('departement');
            $table->string('barang');
            $table->integer('status')->default(1)->comment('1. rusak, 2. perbaikan, 3. selesai');
            $table->string('description');
            $table->string('photo');
            $table->string('location');
            $table->date('date');
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
        Schema::dropIfExists('pengaduans');
    }
};
