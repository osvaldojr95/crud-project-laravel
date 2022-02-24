<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\TiposPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Collection;

class PostsController extends Controller
{
    public function index()
    {
        $data = Post::all();
        //$tipospost_list = collect([null=>"Selecione o tipo do post"]);
        //$tipospost_list = $tipospost_list->concat(TiposPost::all()->pluck("name","id"));
        $tipospost_list = TiposPost::all()->pluck("name","id");
        return view('posts.index', compact("data","tipospost_list"));
    }

    public function store(Request $request)
    {
        $validate = $this->makeRules($request);
        $this->validate($request, $validate['rulesUpdate'], $validate['messages']);

        if ($data = Post::create($request->all())) {
            return view('posts.show', compact("data"));
        }
        return redirect()->route('posts.index');
    }

    public function create()
    {
        $tipospost_list = TiposPost::all()->pluck("name","id");
        return view('posts.create',compact("tipospost_list"));
    }

    public function show($id)
    {
        if ($data = Post::find($id)) {
            return view('posts.show', compact('data'));
        }
        return redirect()->route('posts.index');
    }

    public function update(Request $request, $id)
    {
        if ($data = Post::find($id)) {
            $validate = $this->makeRules($request, $data);
            $this->validate($request, $validate['rulesUpdate'], $validate['messages']);

            if ($data->update($request->all())) {
                return view('posts.show', compact("data"));
            }
        }
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        if ($data = Post::find($id)) {
            $data->delete();
        }
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        if ($data = Post::find($id)) {
            $tipospost_list = TiposPost::all()->pluck("name","id");
            return view('posts.edit', compact("data","tipospost_list"));
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

            'id_tipospost.required' => 'Por favor, selecione o tipo.',
        ];

        $rules = [
            'conteudo' => 'required|min:3|max:255',
            'id_tipospost' => 'required',
        ];

        $rulesUpdate = $rules;

        return [
            'messages' => $messages,
            'rules' => $rules,
            'rulesUpdate' => $rulesUpdate
        ];
    }
}
