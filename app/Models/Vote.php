<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Eloquent
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'vote' => 'boolean',
    ];

    protected $with = [
        'voter',
    ];


    public function votable()
    {
        return $this->morphTo();
    }


    public function page()
    {
        return $this->morphTo(Page::class, 'votable_type', 'votable_id');
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
