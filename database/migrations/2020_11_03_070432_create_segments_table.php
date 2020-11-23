<?php

use App\Models\Genre;
use App\Models\Page;
use App\Models\Theme;
use App\Models\User;
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
            $table->string('title')->index('segments_title_idx');
            $table->string('slug')->unique()->index('segments_slug_idx');
            $table->time('start_time')->nullable()->comment('The timestamp the reference starts');
            $table->time('finish_time')->nullable()->comment('The timestamp the reference finishes');
            $table->boolean('runs_throughout')->nullable()->comment('Does the reference occur throughout the show?');
            $table->longText('details')->comment('The story regarding what is being referenced');
            $table->foreignIdFor(Page::class)->index('segments_page_id_idx');
            $table->foreignIdFor(Genre::class)->index('segments_genre_id_idx');
            $table->foreignIdFor(Theme::class)->index('segments_theme_id_idx');
            $table->foreignIdFor(User::class)->index('segments_user_id_idx');
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
