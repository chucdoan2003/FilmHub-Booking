<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function showComments()
    {
        // Lấy danh sách bình luận theo phim
        $comments = Comment::with(['user', 'movie']) // Lấy cả thông tin người dùng và phim liên quan
        ->orderBy('created_at', 'desc') // Sắp xếp comment từ mới đến cũ
        ->get();

    return view('admin.comments.index', compact('comments'));
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
