<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Like;

use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;
    public function __construct(Like $like){
        $this->like = $like;
    }

    public function store($post_id) { // heart button $post->id
        // Set the user_id attribute with the currently a authenticated user's ID
       $this->like->user_id = Auth::user()->id; // Auth::user()->id to the user's ID who is currently using the application (logged in)

       $this->like->post_id = $post_id;
       // Set the post_id with the parameter $post_id

       $this->like->save();

       return redirect()->back();
    }

    public function destroy($post_id) { //11.14
        // Delete the 'Like' record for the currently authenticated user and given post_id
        $this->like
             ->where('user_id', Auth::user()->id)
             ->where('post_id', $post_id)
             ->delete();

        return redirect()->back();     
    }
}
