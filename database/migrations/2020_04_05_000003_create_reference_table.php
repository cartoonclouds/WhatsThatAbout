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
            $table->timestamp('start_time')->nullable()->comment('The timestampe the reference starts');
            $table->timestamp('finish_time')->nullable()->comment('The timestampe the reference finishes');
            $table->boolean('throughout')->nullable()->comment('Does the reference occur throughout the show?');
            $table->longText('comment')->comment('Poste\'s comments about the thing they\'re referencing');
            $table->string('references')->default('{}')->comment('A JSON object with title as key and URL as value');
            $table->string('imdb_id', 10)->nullable()->index()->comment('Format: tt0123456, to generate URL: http://www.imdb.com/title/tt0123456/');
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
