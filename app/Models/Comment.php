<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Votable;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Eloquent implements Commentable, Votable
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $appends = [
        'exists'
    ];

    protected $withCount = [
        'votes',
    ];


    public function getExistsAttribute()
    {
        return $this->exists;
    }


    public function page()
    {
        return $this->morphTo(Page::class, 'commentable_type', 'commentable_id')->withDefault([
            'deleted' => "<span class='text-muted'>** page deleted **</span>"
        ]);
    }


    public function scene()
    {
        return $this->morphTo(Scene::class, 'commentable_type', 'commentable_id');
    }


    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }


    public function replies()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function parent()
    {
        return $this->morphTo(Comment::class, 'commentable_type', 'commentable_id');
    }


    public function commenter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    /** LEAVE! Required for comments to be commentable */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
