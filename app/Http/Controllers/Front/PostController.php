<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Auth, Str, Image, File;
class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $comments = Comment::where('post_id', $post->id)->orderByDesc('id')->get();
        $liked = Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first() ? true : false;
        return view('front.posts.show', compact('post', 'comments', 'liked'));
    }
    public function create()
    {
        return view('front.posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:posts,slug',
        ]);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->meta_title = $request->meta_title;
        $post->meta_desc = $request->meta_desc;
        $post->meta_keywords = $request->meta_keywords;
        $post->slug = $request->slug;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file_name = Str::slug($request->title) . '-' . time() . '.webp';
            $path = 'uploads/posts/' . $file_name;
            Image::make($file)->encode('webp')->save($path);
            $post->img = $path;
        }
        $post->content = $request->content;
        $post->created_at = now();
        $post->save();
        return redirect()->route('posts.show', $post->slug)->with('success', __('Yazınız başarıyla oluşturuldu.'));
    }

    public function comment(Request $request)
    {
        $request->validate([
            'message' => 'required|min:5|max:255',
            'post_id' => 'required|exists:posts,id'
        ]);
        $post = Post::where('id', $request->post_id)->firstOrFail();
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->post_id = $post->id;
        $comment->user_id = Auth::user()->id;
        if($comment->save()){
            $comments = Comment::where('post_id', $post->id)->orderByDesc('id')->get();
            return view('front.partials.comments', compact('post', 'comments'));
        }
    }

    public function like(Request $request){
        $request->validate([
            'post_id' => 'required|exists:posts,id'
        ]);
        $post = Post::where('id', $request->post_id)->firstOrFail();
        $like = Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
        if($like){
            $like->delete();
        }else{
            $like = new Like();
            $like->post_id = $post->id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }
        return response()->json([
            'likes' => Like::where('post_id', $post->id)->count(),
            'liked' => Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first() ? true : false
        ]);
    }
}
