<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function(Blueprint $table){
            $table->id('id_barang');
            $table->string('nama_barang','100')->unique();
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stok');
            $table->string('foto_barang','200');
            $table->timestamps();
            $table->softDeletes();
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
}
