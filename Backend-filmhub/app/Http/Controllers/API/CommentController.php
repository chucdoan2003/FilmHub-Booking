<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        try {

            $comments = Comment::all();

            return response()->json([
                'message' => 'Lấy bình luận thành công',
                'data' => $comments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy bình luận',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'comment' => 'required|string|max:200',
                'user_id' => 'nullable|integer|exists:users,user_id',
                'movie_id' => 'required|integer|exists:movies,movie_id',
            ]);

            $comment = Comment::create([
                'user_id' => $validated['user_id'],
                'movie_id' => $validated['movie_id'],
                'comment' => $validated['comment'],
            ]);

            return response()->json([
                'message' => 'Thêm bình luận thành công',
                'data' => $comment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi thêm bình luận',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
