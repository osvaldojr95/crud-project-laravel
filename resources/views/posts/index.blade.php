@extends('layouts.main')

@section('content')

    <div class="container-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-title">
                        Lista de posts:
                        <ul class="panel-tools">
                            <li><a class="btn btn-xs btn-info" href="{{route('posts.create')}}"><i
                                            class="fa fa-plus"></i>Novo</a></li>
                        </ul>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $post)
                            {{Form::model($data, array('route' => ['posts.destroy', $post->id], 'method' => 'DELETE'))}}
                                {{Form::submit('enviar',['id'=>"formDelete-$post->id", 'style' => 'display:none;'])}}
                            {{Form::close()}}
                            <tr>
                                <td><b>{{$post->id}}</b></td>
                                <td>{{$post->name}}</td>
                                <td>
                                    <a class="btn btn-xs btn-group" href="{{route('posts.show',[$post->id])}}"><i
                                                class="fa fa-paper"></i>Show</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('posts.edit',[$post->id])}}"><i
                                                class="fa fa-edit"></i>Edit</a>
                                    <a class="btn btn-xs btn-danger" onclick="deletarPost({{$post->id}})" href="#"><i
                                                class="fa fa-trash"></i>Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
    <div class="row footer">
        <div class="col-md-6 text-left">
            Copyright © 2015 <a href="http://themeforest.net/user/egemem/portfolio" target="_blank">Egemem</a> All
            rights reserved.
        </div>
        <div class="col-md-6 text-right">
            Design and Developed by <a href="http://themeforest.net/user/egemem/portfolio" target="_blank">Egemem</a>
        </div>
    </div>


@endsection


@section('script')
    <script>
        function deletarPost(id) {
            document.querySelector("#formDelete-" + id).click();
        }
    </script>
@endsection