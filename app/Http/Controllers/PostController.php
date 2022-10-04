<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderby('id', 'DESC')->get();
        // dd($posts);
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    public function get($slug)
    {

        $post = Post::where('slug', $slug)->firstOrFail();
        return view('post.view-post', [
            'post' => $post
        ]);
        // dd($post->user->name);
    }

    public function create()
    {
        // $categories = Category::all();
        return view('post.post-form');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|unique:posts|max:255',
    //         'category' => 'required',
    //         'body' => 'required',
    //     ]);

    //     if ($request->image) {
    //         $request->image;
    //         $image_name = time() . '.' .  $request->image->getClientOriginalExtension();
    //         $destinationPath = public_path('/storage/images');
    //         $request->image->move($destinationPath, $image_name);
    //     }

    //     $post = Post::create([
    //         'category_id' => $request->category,
    //         'user_id' => Auth::user()->id,
    //         'title' => $request->title,
    //         'slug' =>  Str::slug($request->title),
    //         'body' => $request->body,
    //         'image' => $request->image ? $image_name : null
    //     ]);

    //     return redirect()->route('post.index');
    // }
}
