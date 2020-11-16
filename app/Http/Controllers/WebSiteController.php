<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Mail;
use Session;
use App\Mail\VisitorContact;

class WebSiteController extends Controller
{
    public function index(){
        $categories = Category::orderBy('name', 'asc')->where('is_published', '1')->get();
        $posts = Post::orderBy('id', 'desc')->where('post_type', 'post')->where('is_published', '1')->paginate(5);
        return view('website.template.index', compact('categories', 'posts'));
    }

    public function post($slug){
        $post = Post::where('slug', $slug)->where('post_type', 'post')->where('is_published', '1')->first();
        if($post){
            return view('website.post', compact('post'));
        }else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->where('is_published', '1')->first();

        if($category){
            $posts = $category->posts()->orderBy('post_id', 'desc')->where('is_published', '1')->paginate(5);
            return view('website.category', compact('category', 'posts'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function page($slug)
    {
        $page = Post::where('slug', $slug)->where('post_type', 'page')->where('is_published', '1')->first();
        if ($page){
            return view('website.page', compact('page'));
        } else 
        {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function showContactForm(){
        return view('website.contact');
    }

    public function submitContactForm(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'message' => $request->message
        ];

        Mail::to('bashir4windowslive@gmail.com')->send(new VisitorContact($data));
        Session::flash('message', 'Thank you for your email');
        return redirect()->route('contact.show');
    }
}
