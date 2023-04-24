<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->with('author')->simplePaginate(50);
        return view('front.index', compact('posts'));
    }
}
