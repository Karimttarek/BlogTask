<?php

namespace Modules\Auth\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Blog\Entities\Comment;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * Get all of the comments for the users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
