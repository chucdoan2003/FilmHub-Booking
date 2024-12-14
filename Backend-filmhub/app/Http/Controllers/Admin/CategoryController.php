<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cateogries = CategoryPost::orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('cateogries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category_posts,name',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description
        ];

        CategoryPost::create($data);

        return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công');
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
        $category = CategoryPost::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:category_posts,name,' . $id,
            'description' => 'nullable',
            'status' => 'nullable',
        ]);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description
        ];

        CategoryPost::find($id)->update($data);

        return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CategoryPost::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('admin.category.index')->with('success', 'Xoá danh mục thành công');
        } else {
            return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy danh mục');
        }
    }
}
