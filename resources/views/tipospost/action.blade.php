<a class="btn btn-xs btn-info" href="{{route('tipospost.show', $id)}}"><i class="fa fa-plus"></i>Show</a>
<a class="btn btn-xs btn-info" href="{{route('tipospost.edit', $id)}}"><i class="fa fa-plus"></i>Edit</a>
<a id="{{"botaoDeletar-".$id}}" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>Delete</a>

{{Form::open(array('route' => ['tipospost.destroy',$id],'id' => 'formDelete-'.$id, 'style' => 'display: none;','method' => 'DELETE'))}}
{{Form::submit()}}
{{Form::close()}}

<script type="text/javascript">
    $("#{{'botaoDeletar-'.$id}}").click(function () {
        $("#{{'formDelete-'.$id}}").submit();
    });
</script>