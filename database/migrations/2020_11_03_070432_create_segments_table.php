<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->time('start_time')->nullable()->comment('The timestamp the reference starts');
            $table->time('finish_time')->nullable()->comment('The timestamp the reference finishes');
            $table->boolean('runs_throughout')->nullable()->comment('Does the reference occur throughout the show?');
            $table->longText('details')->comment('The story regarding what is being referenced'); // multiLineString
            $table->json('references')->nullable()->comment('A JSON object with title as key and URL as value');
            $table->integer('page_id')->index();
            $table->integer('user_id')->index();
            $table->softDeletes();
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
        Schema::dropIfExists('segments');
    }
}
