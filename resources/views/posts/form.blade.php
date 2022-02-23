<form>
    <div class="form-group">
        <label for="name">Nome:</label>
        {{Form::text('name',old('name'), array('class' => 'form-control'))}}
        <p class="help-block">@if($errors->first('name')){{ $errors->first('name') }}@endif</p>
    </div>
    <div class="form-group">
        <label for="Tipo do post">Conteúdo:</label>
        {{Form::select('id_tipospost', $tipospost_list, old('id_tipospost'), array('id' => 'tipospost-select','class' => 'form-control'))}}
        <p class="help-block">@if($errors->first('id_tipospost')){{ $errors->first('id_tipospost') }}@endif</p>
    </div>
    <div class="form-group">
        <label for="conteudo">Conteúdo:</label>
        {{Form::textarea('conteudo',old('conteudo'), array('class' => 'form-control'))}}
        <p class="help-block">@if($errors->first('conteudo')){{ $errors->first('conteudo') }}@endif</p>
    </div>
    {{Form::submit()}}
</form>