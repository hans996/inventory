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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('inventory_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->integer('status')->comment('1=pending,2=prosess,3=finish');
            $table->string('kode_permintaan')->unique();
            $table->integer('jumlah');
            $table->timestamps();
            
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
};
