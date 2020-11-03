<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Eloquent
{
    use HasFactory;

    protected $casts = [
        'vote' => 'boolean',
    ];

    public function votable()
    {
        return $this->morphTo();
    }

    public function show()
    {
        return $this->morphTo(Show::class, 'votable_type', 'votable_id');
    }

    public function segment()
    {
        return $this->morphTo(Segment::class, 'votable_type', 'votable_id');
    }

    public function voter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
