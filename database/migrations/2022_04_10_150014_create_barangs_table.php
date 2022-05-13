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
            $table->unsignedInteger('id_user')
                ->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_satuan')
                ->foreign('id_satuan')->references('id')->on('satuans')->onDelete('cascade');
            $table->boolean('kategori')->default(false);
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
