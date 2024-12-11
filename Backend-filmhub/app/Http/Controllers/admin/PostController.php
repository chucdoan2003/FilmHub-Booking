<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryPost::where('status', 1)->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:posts,name',
            'category_id' => 'required',
            'avatar' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:4048',
            'description' => 'nullable',
            'content' => 'required',

        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'content' => $request->content
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('public/posts');
            $data['avatar'] = Storage::url($path);
        }

        Post::create($data);
        return redirect()->route('admin.post.index')->with('success', 'Thêm tin tức thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = CategoryPost::where('status', 1,2 )->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|unique:posts,name,' . $id,
            'category_id' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg|max:4048',
            'description' => 'nullable',
            'content' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'content' => $request->content
        ];
        $post = Post::find($id);

        if ($request->hasFile('avatar')) {
            if (!empty($post->avatar)) {
                $filePath = str_replace('/storage', 'public', $post->avatar);

                if (Storage::exists($filePath)) {
                    Storage::delete($filePath); // Xóa file
                }
            }
            $file = $request->file('avatar');
            $path = $file->store('public/posts');
            $data['avatar'] = Storage::url($path);
        }

        $post->update($data);
        return redirect()->route('admin.post.index')->with('success', 'Cập nhật tin tức thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            if (!empty($post->avatar)) {
                $filePath = str_replace('/storage', 'public', $post->avatar);
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath); // Xóa file
                }
            }
            $post->delete();
            return redirect()->route('admin.post.index')->with('success', 'Xóa tin tức thành công.');
        }
    }
}
