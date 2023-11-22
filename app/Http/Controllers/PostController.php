<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post; // Import the Post Model && Category Model

use App\Models\Category;  

use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // Create private variables to hold POST and CATEGORY model
    private $post;

    private $category;

    // Assign the Post and category models to the variables
    public function __construct(Post $post, Category $category){
        $this->post = $post;
        $this->category = $category;
       
    }

    public function create(){
        $all_categories = $this->category->all();

        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request){
        // Validate all form data
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'      
        ]);

        // Save the Post
       $this->post->user_id = Auth::user()->id;
       // Set the User ID of the post to the current User's ID

       $this->post->image = 'data:/image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
       // Set the image path of the post to the base64 encoded image data   

       $this->post->description = $request->description;
       // Set the description of the post to the value of the 'description' request parameter
       
       $this->post->save(); // Save the post to the database

      // Save the categories to the category_post Table (Pivot Table)
      foreach ($request->category as $category_id){
        // Create an associative array with the Category ID as the Key
        $category_post[] = ['category_id' => $category_id];
     }

      // Create a new CategoryPost record for each category ID
      $this->post->categoryPost()->createMany($category_post); // createMany was used to inset multiple records

     // Go back to the homepage
     return redirect()->route('index');   
    }
    // 11.9
    public function show($id){
        $post = $this->post->findOrFail($id);
        // 11.8 Retrieve the post with the given $id from the posts table and all the columns value

        return view('users.posts.show')->with('post', $post);
        // Pass the retrieved post to the view
    }

    public function edit($id){
        
        $post = $this->post->findOrFail($id);

        // If the Auth user is not the owner of the post,redirect to the homepage
        if(Auth::user()->id != $post->user->id){
            return redirect()->route('index');
        }

        $all_categories = $this->category->all();

        // Get all the category ID of this post. Save in an array
        $selected_categories = [];
        foreach ($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
            ->with('post', $post)
            ->with('all_categories', $all_categories)
            ->with('selected_categories', $selected_categories);
    }


    public function update(Request $request, $id){
        // Validate the data from the form
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'mimes:jpeg,jpg,png,gif|max:1048' 
        ]);

        // Update the post
        $post = $this->post->findOrFail($id);
        $post->description = $request->description;

        // If there is a new image
        if ($request->image) {
            $post->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image)); // The image is not required
        }

        $post->save();

        // Delete all records from category_post related to this post
        $post->categoryPost()->delete();
        // Use the relationship Post::categoryPost() to select the records related to a post
        // DELETE FROM category_post WHERE post_id = $id

        // Save the new categories to the category_post table
        foreach ($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }
        $post->categoryPost()->createMany($category_post);

        // Redirect to Show Post Page (to confirm the update)
        return redirect()->route('post.show',$id);
    }

    // public function delete($id){　destroyだけで動く。
    //     $post = $this->post->findOrFail($id);
    //     return view('users.posts.contents.modals.delete')->with('post',$post);
    // }

    public function destroy($id){
        // $post = $this->post->findOrFail($id);
        // $this->delete($post->id);

        $post = $this->post->findOrFail($id);

        // 11.20 Permanently delete the retrieved posts from the database
        // destroy() is for soft delete
        $post->forceDelete();

        return redirect()->route('index');
    }
    
}
