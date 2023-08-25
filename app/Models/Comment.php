<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Login;

class Comment extends Model
{
    protected $table = 'tbl_comment';

    public function user()
    {
        return $this->belongsTo(Login::class);
    }
}
