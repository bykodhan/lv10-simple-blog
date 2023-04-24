<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Auth, Str, Image, File;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('likes','author')->orderByDesc('created_at')->paginate(10);
        $posts_count = Post::count();
        return view('back.posts.index', compact('posts', 'posts_count'));
    }

    public function edit(Post $post)
    {
        return view('back.posts.edit', compact('post'));
    }

    public function create()
    {
        return view('back.posts.create');
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
        return redirect()->route('admin.posts')->with('success', __('Yazı başarıyla oluşturuldu'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);
        $post = Post::findorFail($request->id);
        if($request->slug != $post->slug){
            $request->validate([
                'slug' => 'required|min:3|max:255|unique:posts,slug',
            ]);
        }
        $post->title = $request->title;
        $post->meta_title = $request->meta_title;
        $post->meta_desc = $request->meta_desc;
        $post->meta_keywords = $request->meta_keywords;
        $post->slug = $request->slug;
        if ($request->hasFile('img')) {
            File::delete($post->img);
            $file = $request->file('img');
            $file_name = Str::slug($request->name) . '-' . time() . '.webp';
            $path = 'uploads/posts/' . $file_name;
            Image::make($file)->encode('webp')->save($path);
            $post->img = $path;
        }
        $post->content = $request->content;
        $post->updated_at = now();
        $post->save();
        return redirect()->route('admin.posts')->with('success', __('Yazı başarıyla güncellendi'));
    }

    public function destroy(Request $request)
    {
        $post = Post::findorFail($request->id);
        if ($post->img) {
            File::delete($post->img);
        }
        $post->delete();
        return redirect()->route('admin.posts')->with('success', __('Yazı başarıyla silindi'));
    }


}
