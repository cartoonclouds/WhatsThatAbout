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

    public function getExistsAttribute()
    {
        return $this->exists;
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function parentComment()
    {
        return $this->morphTo(Comment::class, 'commentable_type', 'commentable_id');
    }

    public function page()
    {
        return $this->morphTo(Page::class, 'commentable_type', 'commentable_id');
    }

    public function segment()
    {
        return $this->morphTo(Segment::class, 'commentable_type', 'commentable_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function commenter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
