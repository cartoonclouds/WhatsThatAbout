<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

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
            $table->string('title')->index();
            $table->string('slug')->unique()->index();
            $table->longText('synopsis');
            $table->year('release_year')->nullable();
            $table->string('thumbnail');
            $table->time('runtime')->nullable();
            $table->json('references')->nullable();
            $table->boolean('is_published')->default('0');
            $table->integer('rating_id')->index();
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
