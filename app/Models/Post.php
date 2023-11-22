<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\SoftDeletes; // 11.17

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // A post belongs to a user
    // To get the owner of the post
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
        // The repercussion of deletes means retrieving data that has been soft deleted 11.16
    }

    //To get the categories under a post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    // 11.9 To retrieve all the comments associate with a post
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // 11.13
    public function likes() {
        // To get the likes of a post
        return $this->hasMany(Like::class);
    }
    
    // 11.14
    public function isLiked() {
        // Return TRUE if the AUTH user already liked the post
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
