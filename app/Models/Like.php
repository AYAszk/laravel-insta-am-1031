<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function Likes() { // 11.24
        // This will retrieve the user who liked post
        return $this->belongsTo(User::class, 'user_id'); // データ参照。
    }
}
