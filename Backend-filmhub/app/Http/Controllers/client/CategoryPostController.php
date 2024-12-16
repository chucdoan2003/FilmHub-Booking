<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function categoryPost($id)
    {
        $category = CategoryPost::find($id);
        $postByCategory = $category->posts()->paginate(6);
        $postNew = Post::limit(6)->get();
        $listCategory = CategoryPost::withCount('posts')->get();
        return view('frontend.categoryPost.index', compact('category', 'postNew', 'listCategory', 'postByCategory'));
    }
}
