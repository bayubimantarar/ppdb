<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('calon_peserta_didik_id');
            $table->string('provinsi', 150)->nullable();
            $table->string('kabupaten_kota', 150)->nullable();
            $table->string('kecamatan', 150)->nullable();
            $table->string('kode_pos', 150)->nullable();
            $table->text('alamat');
            $table->string('latitude', 150);
            $table->string('longitude', 150);
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
        Schema::dropIfExists('alamat');
    }
}
