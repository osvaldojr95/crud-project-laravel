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
        $validate = $this->makeRules($request);
        $this->validate($request,$validate['rulesUpdate'],$validate['messages']);

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
            $validate = $this->makeRules($request,$data);
            $this->validate($request,$validate['rulesUpdate'],$validate['messages']);

            if($data->update($request->all())){
                return view('posts.show',compact("data"));
            }
        }
        return redirect()->route('posts.index');
    }

    public function destroy($id) {
        if($data = Post::find($id)){
            $data->delete();
        }
        return redirect()->route('posts.index');
    }

    public function edit($id) {
        if($data = Post::find($id)){
            return view('posts.edit',compact("data"));
        }
        return redirect()->route('posts.index');
    }

    private function makeRules(Request $request, $data = null)
    {
        $messages = [
            'name.required' => 'Por favor, informe o nome.',
            'name.min' => 'Nome inválido, mínimo 03 caracteres.',
            'name.max' => 'Nome inválido, máximo 255 caracteres.',

            'conteudo.required' => 'Por favor, informe o nome.',
            'conteudo.min' => 'Nome inválido, mínimo 03 caracteres.',
            'conteudo.max' => 'Nome inválido, máximo 255 caracteres.',
        ];

        $rules = [
            'conteudo' => 'required|min:3|max:255',
        ];

        $rulesUpdate = $rules;

        return [
            'messages' => $messages,
            'rules' => $rules,
            'rulesUpdate' => $rulesUpdate
        ];
    }
}
