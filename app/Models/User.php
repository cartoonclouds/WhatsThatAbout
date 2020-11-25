<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Votable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Commentable, Votable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    public const ROLE_SUPER_ADMIN = 'super-admin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MOD = 'moderator';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected $casts = [
        //
    ];

    protected $with = [
        'avatar',
    ];

    protected $dates = [
        'email_verified_at',
    ];

    protected $appends = [
        'url'
    ];


    public function getUrlAttribute()
    {
        return url('user/' . $this->id);
    }


    public function pages()
    {
        return $this->hasMany(Page::class);
    }


    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function votes()
    {
        return $this->hasMany(Vote::class);
    }


    public function avatar()
    {
        return $this->morphOne(Image::class, 'imageable')->where('cover', true)->withDefault();
    }


    public function images()
    {
        return $this->morphOne(Image::class, 'imageable')->where('cover', true)->withDefault();
    }
}
