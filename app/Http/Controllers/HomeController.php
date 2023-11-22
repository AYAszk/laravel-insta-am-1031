<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\Post;

use Illuminate\Support\Facades\Auth;

use App\Models\User; // 11.15

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $post;

     private $user; // 11.15


    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$all_posts = $this->post->latest()->get();
        //return view('users.home')->with('all_posts',$all_posts); //users内のhome.blade.php
        //->with('all_posts', $all_posts)： with メソッドを使用して、ビューに 'all_posts' という名前の変数を渡す。この変数には、コントローラで取得した記事のデータが含まれている。これにより、ビュー内で all_posts 変数を使用して記事データにアクセスできる。
        // 11.15
        $home_posts = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();
        // This method is likely responsible for fetching a list of users that are suggested for the current user.
        return view('users.home')->with('home_posts', $home_posts)
                                 ->with('suggested_users', $suggested_users);
    } 

    private function getHomePosts() {
        // Get the posts of the users that the AUTH user if following
        $all_posts = $this->post->latest()->get();

        $home_posts = []; // [1,2,3,5] 
        // In case the $home_posts is empty, it will not return NULL

        foreach ($all_posts as $post) {
            if ($post->user->isFollowed() || $post->user->id === Auth::user()->id) {
                $home_posts[] = $post;
            }
        }
        return $home_posts;
    }

    private function getSuggestedUsers() { // 11.15
        // Get the users that the Auth user is not following
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach ($all_users as $user) {
            if (!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }
        //return $suggested_users;
        return array_slice($suggested_users,0,3); // 11.16 お勧め3つまで表示する。
        // array_slice ** php built-in function that extracts a slice of an array
        // array_slice(x,y,z)
        // x = array
        // y = offset/starting index
        // z = length/how many
    }   
    public function search(Request $request) { // 11.22
        // Searches for users in the database whose 'name' column partially matches the search term
        $users = $this->user->where('name', 'like', '%'.$request->search.'%')->get();

        // 'name' refers to the column 'name' in the users table
        // 'like' Specifies a partial match
        // '%'.$request->search.'%' - Represents the search term, enclosed in % signs the term can appear at the begging, middle, or end of the 'name'

        return view('users.search')
                   ->with('users', $users) // Passes the retrieved user data to the view using the variable name '$users'
                   ->with('search', $request->search); // Passes the search term to the view using the variable name 'search'
    }
}
