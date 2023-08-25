<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Login;
use App\Models\Comment;

class Forum extends Model
{
    protected $table = 'tbl_forum';

    public function user()
    {
        return $this->belongsTo(Login::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
