<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post; //11.17

class PostsController extends Controller 
{
    private $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index() {
        $all_posts = $this->post->withTrashed()->latest()->paginate(5);
        // withTrashed() includes trashed records in query (soft delete)

        return view('admin.posts.index')->with('all_posts', $all_posts); //データと一緒に値を渡す。
    }

    public function hide($id) {
        // Deleted post by ID
        $this->post->destroy($id);
        return redirect()->back();
    }

    public function unhide($id) {
        // Find and restores trashed post by ID using onlyTrashed() to filter only the trashed records (soft deleted)
        $this->post->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
