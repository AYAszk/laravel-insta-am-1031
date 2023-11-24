<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function Likes(){ // 11.24
        $this->belongsTo(User::class);
    }
}
