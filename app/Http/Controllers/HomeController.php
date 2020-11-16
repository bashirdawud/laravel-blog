<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->limit('3')->get();
        $posts = Post::orderBy('id', 'desc')->where('post_type', 'page')->limit('3')->get();
        $pages = Post::orderBy('id', 'desc')->where('post_type', 'page')->limit('3')->get();
        return view('admin.index', compact('categories', 'posts', 'pages'));
    }
}
