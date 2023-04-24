<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderByDesc('created_at')->paginate(10);
        return view('back.comments.index', compact('comments'));
    }
    public function destroy(Request $request)
    {
        $comment = Comment::findorFail($request->id);
        $comment->delete();
        return redirect()->back()->with('success', __('Yorum başarıyla silindi'));
    }
}
