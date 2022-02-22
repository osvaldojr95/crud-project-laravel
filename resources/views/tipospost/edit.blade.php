@extends('layouts.main')

@section('content')

    <div class="container-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-title">
                        Lista de posts:
                        <ul class="panel-tools">
                            <li><a class="btn btn-sm btn-edit" href="{{route('tipospost.index')}}"><i
                                            class="fa fa-plus"></i>Voltar</a></li>
                        </ul>
                    </div>

                    {{Form::model($data, array('route' => ['tipospost.update', $data->id], 'method' => 'PUT'))}}
                    @include('tipospost.form')
                    {{Form::close()}}

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