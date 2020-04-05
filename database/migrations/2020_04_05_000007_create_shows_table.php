<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'shows';

    /**
     * Run the migrations.
     * @table shows
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id()->unique();
            $table->string('imdb_id', 10)->nullable()->index();
            $table->string('wikipedia_url')->nullable();
            $table->string('official_website_url')->nullable();
            $table->longText('image_url');
            $table->time('running_length')->nullable();
            $table->boolean('is_draft')->default('1');
            $table->integer('user_id')->index();
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
       Schema::dropIfExists($this->tableName);
     }
}
