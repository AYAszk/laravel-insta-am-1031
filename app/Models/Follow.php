<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = false;  // 0  // TRUE 1  11.14

    public function follower() { // 11.14
        // Returns information about the follower of this user
        // It associates this user with a 'User' record based of the follower_id
        return $this->belongsTo(User::class, 'follower_id')->withTrashed(); // ID of your own account.
    }

    public function following() {
        // To get the information of the user being followed
        // It associates this user with a 'User' record based on following_id
        return $this->belongsTo(User::class, 'following_id')->withTrashed();
    }
}
