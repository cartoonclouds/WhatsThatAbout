<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingShowTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'rating_show';

    /**
     * Run the migrations.
     * @table rating_show
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->integer('rating_id');
            $table->integer('show_id');
            $table->timestamps();

            $table->unique(['rating_id', 'show_id'])->primary()->index();
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
