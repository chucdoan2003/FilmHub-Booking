<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function showComments(Request $request)
    {
        $query = Comment::query();

        if ($request->has('movie_id') && $request->movie_id != '') {
            $query->where('movie_id', $request->movie_id);
        }

        $comments = $query->with(['user', 'movie'])->get();
        $movies = Movie::all();
        // dd($request->all());

        return view('admin.comments.index', compact('comments', 'movies'));
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->back()->with('error', 'Bình luận không tồn tại!');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Đã xóa bình luận thành công!');
    }
}
