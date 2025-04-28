<div class="form-group{{ $errors->has('startingtime') ? ' has-error' : ''}}">
    {!! Form::label('startingtime', 'Startingtime: ', ['class' => 'control-label']) !!}
    {!! Form::date('startingtime',null, ['class' => 'form-control', 'required' => 'required']) !!} 
    {!! $errors->first('startingtime', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('endtime') ? ' has-error' : ''}}">
    {!! Form::label('endtime', 'Endtime: ', ['class' => 'control-label']) !!}
    {!! Form::date('endtime', null, ['class' => 'form-control']) !!}
    {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('price') ? ' has-error' : ''}}">
    {!! Form::label('price', 'Price: ', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
    {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
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
        <label for="product-content">Product</label>
        <select name="product_id" class="form-control">
        @foreach($products as $product)
        <option value="{{$product->id}}">{{$product->productname}}</option>
        @endforeach
        </select>
        </div>
<!--input type="datetime-local"/-->
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
