<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index() {
        $data = Post::all();
        return view('posts.index',compact("data"));
    }

    public function store(Request $request) {
        if($data = Post::create($request->all())){
            return view('posts.show',compact("data"));
        }
        return redirect()->route('posts.index');
    }

    public function create() {
        return view('posts.create');
    }

    public function show($id) {
        if($data = Post::find($id)){
            return view('posts.show',compact('data'));
        }
        return redirect()->route('posts.index');
    }

    public function update(Request $request, $id) {
        if($data = Post::find($id)){
            if($data->update($request->all())){
                return view('posts.show',compact("data"));
            }
        }
        return redirect()->route('posts.index');
    }

    public function destroy() {
        dd("NaN");
    }

    public function edit($id) {
        if($data = Post::find($id)){
            return view('posts.edit',compact("data"));
        }
        return redirect()->route('posts.index');
    }
}
