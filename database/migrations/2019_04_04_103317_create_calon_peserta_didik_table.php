<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonPesertaDidikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_peserta_didik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nisn', 20);
            $table->text('alamat');
            $table->string('latitude', 150);
            $table->string('longitude', 150);
            $table->string('nilai_nhun', 15);
            $table->string('skor_jarak', 15);
            $table->string('skor_total', 15);
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
        Schema::dropIfExists('calon_peserta_didik');
    }
}
