<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreShowTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'genre_show';

    /**
     * Run the migrations.
     * @table genre_shows
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->integer('genre_id');
            $table->integer('show_id');
            $table->timestamps();

            $table->unique(['genre_id', 'show_id'])->primary()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
