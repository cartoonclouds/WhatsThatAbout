<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'references';

    /**
     * Run the migrations.
     * @table reference
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id()->unique();
            $table->time('start_time')->nullable()->comment('The timestampe the reference starts');
            $table->time('finish_time')->nullable()->comment('The timestampe the reference finishes');
            $table->boolean('runs_throughout')->nullable()->comment('Does the reference occur throughout the show?');
            $table->longText('details')->comment('The story regarding what is being referenced');
            $table->json('references')->nullable()->comment('A JSON object with title as key and URL as value');
            $table->integer('show_id')->index();
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
