<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Post; //11.20

class CategoriesController extends Controller
{
    private $category;

    private $post;

    public function __construct(Category $category, Post $post){ // 11.20 $post
        $this->category = $category;
        $this->post = $post;
    }

    public function index() {
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(10);

        $uncategorized_count = 0;

        $all_posts = $this->post->all();

        foreach ($all_posts as $post) {
            if($post->categoryPost->count() == 0){
                $uncategorized_count++;
            }
        }

        return view('admin.categories.index')
                            ->with('all_categories', $all_categories)
                            ->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name' // all categories must be unique
        ]);

        $this->category->name = ucwords(strtolower($request->name));
        // ucwords() uppercase the first letter of each word

        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'new_name' => 'required|min:1|max:50|unique:categories,name,'.$id // all categories must be unique
        ]);

        $category = $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->new_name));
        $category->save();

        return redirect()->back();
    }

    public function destroy($id) {
        $this->category->destroy($id); // permanently delete the data - since we did not use for any soft deletes
        return redirect()->back();
    }
}
