<div class="form-group{{ $errors->has('productname') ? 'has-error' : ''}}">
    {!! Form::label('productname', 'productname', ['class' => 'control-label']) !!}
    {!! Form::text('productname', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('productname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('productdetail') ? 'has-error' : ''}}">
    {!! Form::label('productdetail', 'productdetail', ['class' => 'control-label']) !!}
    {!! Form::text('productdetail', null, ['class' => 'form-control crud-text']) !!}
    {!! $errors->first('productdetail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('remainingtime') ? 'has-error' : ''}}">
    {!! Form::label('remainingtime', 'remainingtime', ['class' => 'control-label']) !!}
    {!! Form::date('remainingtime', null, ['class' => 'form-control crud-text']) !!}
    {!! $errors->first('remainingtime', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('size') ? 'has-error' : ''}}">
    {!! Form::label('size', 'size', ['class' => 'control-label']) !!}
    {!! Form::text('size', null, ['class' => 'form-control crud-text']) !!}
    {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'price', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control crud-text']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="user-content">User</label>
    <select name="user_id" class="form-control">
    @foreach($users as $user)
    <option value="{{$user->id}}">{{$user->username}}</option>
    @endforeach
    </select>
    </div>

<div class="form-group">
<label for="category-content">select category</label>
<select name="cat_id" class="form-control">
@foreach($categories as $cat)
<option value="{{$cat->id}}">{{$cat->cat_name}}</option>
@endforeach
</select>
</div>


<form action="{{ route('picture') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <input type="file" name="picture" class="form-control">
        </div>

    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}

</div>
</form>
