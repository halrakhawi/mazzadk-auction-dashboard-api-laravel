<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('cat_name', 'Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('cat_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('cat_name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
