<a class="btn btn-sm btn-success" href="{{route('posts.show', $id)}}"><i class="fa fa-file-text"></i>Show</a>
<a class="btn btn-sm btn-primary" href="{{route('posts.edit', $id)}}"><i class="fa fa-edit"></i>Edit</a>
<a id="{{"botaoDeletar-".$id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>

{{Form::open(array('route' => ['posts.destroy',$id],'id' => 'formDelete-'.$id, 'style' => 'display: none;','method' => 'DELETE'))}}
{{Form::submit()}}
{{Form::close()}}

<script type="text/javascript">
    $("#{{'botaoDeletar-'.$id}}").click(function () {
        $("#{{'formDelete-'.$id}}").submit();
    });
</script>