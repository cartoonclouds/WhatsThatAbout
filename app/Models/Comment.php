<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Eloquent
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }


    public function segment()
    {
        return $this->morphTo(Segment::class, 'commentable_type', 'commentable_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function commenter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
