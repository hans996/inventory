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
    Schema::create('ruang', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('kode_barang')->nullable()->unique();
        $table->unsignedBigInteger('user_id');
        $table->string('lokasi')->nullable();
        $table->integer('jumlah');
        $table->string('keterangan')->nullable();
        $table->integer('jenis')->comment('1=sarana,2=prasarana,3=lainnya');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruang');
    }
};
