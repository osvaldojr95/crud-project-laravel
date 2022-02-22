<form>
    <div class="form-group">
        <label for="name">Nome:</label>
        {{Form::text('name',old('name'), array('class' => 'form-control'))}}
        <p class="help-block">@if($errors->first('name')){{ $errors->first('name') }}@endif</p>
    </div>
    {{Form::submit()}}
</form>