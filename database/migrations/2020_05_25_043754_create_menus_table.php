<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu', 32);
            $table->string('foto_menu');
            $table->enum('jenis_menu', ['makanan', 'minuman']);
            $table->unsignedTinyInteger('jml_tersedia');
            $table->unsignedTinyInteger('jml_dipesan')->default(0);
            $table->integer('harga');
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
        Schema::dropIfExists('menus');
    }
}
