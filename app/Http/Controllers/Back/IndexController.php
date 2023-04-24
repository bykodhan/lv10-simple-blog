<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
class IndexController extends Controller
{
    public function index()
    {
        $post_count = Post::count();
        $comment_count = Comment::count();
        return view('back.index', compact('post_count', 'comment_count'));
    }
}
