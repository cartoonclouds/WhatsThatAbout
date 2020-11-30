<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Votable;
use App\Traits\AppendModelRoutes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, Commentable, Votable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use AppendModelRoutes;
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
        //
    ];

    protected $dates = [
        'email_verified_at',
    ];


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
}
