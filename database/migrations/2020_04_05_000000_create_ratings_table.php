<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'ratings';

    /**
     * Run the migrations.
     * @table ratings
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id()->unique();
            $table->string('country', 3)->default('AUS')->comment('Must use the (ISO-3166-1 ALPHA-3) 3-letter country abbreivations, see: https://laendercode.net/en/3-letter-list.html');
            $table->string('rating')->comment('See: https://www.wikiwand.com/en/Motion_picture_content_rating_system; G, PG, M, MA, R');
            $table->longText('description')->nullable();
            $table->string('reference_url')->nullable();

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
