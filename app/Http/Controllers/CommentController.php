<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

use  Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    private $comment;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }


    public function store(Request $request, $post_id) { //11.10
        // Validate the comment input based on the $post_id parameter
        $request->validate([
            'comment_body'.$post_id => 'required|max:150'
        ],
        [
            'comment_body'.$post_id.'.required' => 'You cannot submit an empty comment.',
            'comment_body'.$post_id.'.max' => 'The comment must not have more than 150 characters.'
        ]
    );

        // Set the 'body' attribute of the comment from the request input
        $this->comment->body = $request->input('comment_body'.$post_id);

        // Set the 'user_id' of the comment from the request
        $this->comment->user_id = Auth::user()->id;

        // Set the 'post_id' of the comment to the value of $post_id
        $this->comment->post_id = $post_id;

        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id) {
        // Delete the comment with the specified ID from the database using Eloquent destroy method
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
