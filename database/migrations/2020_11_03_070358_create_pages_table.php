<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug')->unique()->index('pages_slug_idx');
            $table->longText('synopsis'); // multiLineString
            $table->year('release_year')->index('pages_release_year_idx')->nullable();
            $table->time('runtime')->nullable();
            $table->integer('user_id')->index('pages_user_id_idx');
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
        Schema::dropIfExists('pages');
    }
}
