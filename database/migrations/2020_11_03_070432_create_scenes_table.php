<?php

use App\Models\Genre;
use App\Models\Page;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index('scenes_title_idx');
            $table->string('slug')->unique()->index('scenes_slug_idx');
            $table->time('start_time')->nullable()->comment('The timestamp the reference starts');
            $table->time('finish_time')->nullable()->comment('The timestamp the reference finishes');
            $table->boolean('runs_throughout')->nullable()->comment('Does the reference occur throughout the show?');
            $table->longText('details')->comment('The story regarding what is being referenced');
            $table->foreignIdFor(Page::class)->index('scenes_page_id_idx');
            $table->foreignIdFor(Genre::class)->index('scenes_genre_id_idx');
            $table->foreignIdFor(Theme::class)->index('scenes_theme_id_idx');
            $table->foreignIdFor(User::class)->index('scenes_user_id_idx');
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
        Schema::dropIfExists('scenes');
    }
}
