<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Eloquent
{
    use HasFactory;
    use SoftDeletes;

    public function commentable()
    {
        return $this->morphTo();
    }

    public function page()
    {
        return $this->morphTo(Page::class, 'commentable_type', 'commentable_id');
    }

    public function segment()
    {
        return $this->morphTo(Segment::class, 'commentable_type', 'commentable_id');
    }

    public function commenter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
