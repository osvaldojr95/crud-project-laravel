<?php

namespace App\Http\Controllers;

use App\Models\TiposPost;
use Illuminate\Http\Request;

class TiposPostController extends Controller
{

    public function index() {
        $data = TiposPost::all();
        return view('tipospost.index',compact("data"));
    }

    public function store(Request $request) {
        $validate = $this->makeRules($request);
        $this->validate($request,$validate['rulesUpdate'],$validate['messages']);

        if($data = TiposPost::create($request->all())){
            return view('tipospost.show',compact("data"));
        }
        return redirect()->route('tipospost.index');
    }

    public function create() {
        return view('tipospost.create');
    }

    public function show($id) {
        if($data = TiposPost::find($id)){
            return view('tipospost.show',compact('data'));
        }
        return redirect()->route('tipospost.index');
    }

    public function update(Request $request, $id) {

        if($data = TiposPost::find($id)){
            $validate = $this->makeRules($request,$data);
            $this->validate($request,$validate['rulesUpdate'],$validate['messages']);

            if($data->update($request->all())){
                return view('tipospost.show',compact("data"));
            }
        }
        return redirect()->route('tipospost.index');
    }

    public function destroy($id) {
        if($data = TiposPost::find($id)){
            $data->delete();
        }
        return redirect()->route('tipospost.index');
    }

    public function edit($id) {
        if($data = TiposPost::find($id)){
            return view('tipospost.edit',compact("data"));
        }
        return redirect()->route('tipospost.index');
    }

    private function makeRules(Request $request, $data = null)
    {
        $messages = [
            'name.required' => 'Por favor, informe o nome.',
            'name.min' => 'Nome inválido, mínimo 03 caracteres.',
            'name.max' => 'Nome inválido, máximo 255 caracteres.',
        ];

        $rules = [
            'name' => 'required|min:3|max:255',
        ];

        $rulesUpdate = $rules;

        return [
            'messages' => $messages,
            'rules' => $rules,
            'rulesUpdate' => $rulesUpdate
        ];
    }
}
