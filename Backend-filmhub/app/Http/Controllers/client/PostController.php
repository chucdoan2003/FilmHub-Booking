<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postDetail($id)
    {
        $post = Post::where('id', $id)->first();
        $postNew = Post::where('category_id', $post->category_id)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(6)->get();
        $listCategory = CategoryPost::withCount('posts')->get();
        return view('frontend.posts.index', compact('post', 'postNew', 'listCategory'));
    }
}
