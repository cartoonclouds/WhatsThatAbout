<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    public const ROLE_SUPER_ADMIN = 'super-admin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MOD = 'moderator';

    /**
     * The attributes that are mass assignable.d
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUrlAttribute()
    {
        return url('users/' . $this->id);
    }


    public function pages()
    {
        return $this->hasMany(Page::class);
    }


    public function segments()
    {
        return $this->hasMany(Segment::class);
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
