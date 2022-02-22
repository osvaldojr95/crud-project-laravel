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
                    <table class="table table-hover" id="tablePost">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
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
    <script type="text/javascript">
        var urlPostsDefault = '{{ url('ajax/posts') }}';
        var tablePosts;

        function refreshTableBanners() {
            tablePosts.ajax.url(urlPostsDefault);
            tablePosts.draw();
        }

        $(document).ready(function () {
            tablePosts = $('#tablePost').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json'
                },
                searchDelay: 2500,
                processing: true,
                serverSide: true,
                autoWidth: false,
                paging: true,
                order: [0, 'desc'],
                ajax: {
                    url: urlPostsDefault,
                    type: 'GET'
                },
                fixedColumns: true,
                columns: [
                    {
                        data: 'id',
                        width: '40px',
                        className: "text-right"
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'action'
                    }
                ]
            });
        });
    </script>
@endsection