<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Eloquent
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'vote' => 'boolean',
    ];

    protected $with = [
        'voter',
    ];


    public function scopeUpVotes(Builder $query)
    {
        return $query->where('vote', 1);
    }


    public function scopeDownVotes(Builder $query)
    {
        return $query->where('vote', 0);
    }


    public function votable()
    {
        return $this->morphTo();
    }


    public function page()
    {
        return $this->morphTo(Page::class, 'votable_type', 'votable_id')->withDefault([
            'deleted' => "<span class='text-muted'>** page deleted **</span>"
        ]);
    }


    public function scene()
    {
        return $this->morphTo(Scene::class, 'votable_type', 'votable_id');
    }


    public function voter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
