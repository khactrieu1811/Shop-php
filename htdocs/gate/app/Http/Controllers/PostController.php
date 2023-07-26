<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AuthServiceProvider;
use App\Policies\PostPolicy;

class PostController extends Controller
{
    public function index(){
        $post = Post::all();
        return view('list', compact('post'));
    }
    public function show($id)
    {
        $post = Post::find($id);
        if(auth()->user()->can('view', $post)) {
            return view('show', compact('post'));
        }else{
            abort(403);
        }
    }
    public function create(){
        if (auth()->user()->can('create', Post::class)) {
            dd('create post');
        }else{
            abort(403);
        }
    }
}
