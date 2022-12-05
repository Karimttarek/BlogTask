<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Blog\Entities\Post;
use Modules\Auth\Entities\User;

class Comment extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'comments';
    /**
     * Get the user that owns the File
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
