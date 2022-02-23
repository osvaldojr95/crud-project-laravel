@extends('layouts.main')

@section('content')

    <div class="container-default">
        <div class="changelogs">
            <div class="update">
                <span class="label label-default version">Post</span>
                <a class="date btn btn-sm btn-primary" href="{{route('posts.index')}}"><i class="fa fa-edit"></i>Volar</a>
                <span class="dot"></span>
                <span class="line"></span>

                <div class="list">
                    <h4>ID</h4>
                    <div class="desc">{{$data->id}}</div>
                </div>

                <div class="list">
                    <h4>Name</h4>
                    <div class="desc">{{$data->name}}</div>
                </div>

                <div class="list">
                    <h4>Tipo do post</h4>
                    <div class="desc">{{$data->tipospost->name}}</div>
                </div>

                <div class="list">
                    <h4>Conteúdo</h4>
                    <div class="desc">{{$data->conteudo}}</div>
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