<div class="form-group{{ $errors->has('product_id') ? ' has-error' : ''}}">
    {!! Form::label('product_id', 'product_id: ', ['class' => 'control-label']) !!}
    {!! Form::text('product_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="user-content">User</label>
    <select name="user_id" class="form-control">
    @foreach($users as $user)
    <option value="{{$user->id}}">{{$user->username}}</option>
    @endforeach
    </select>
    </div>
<div class="form-group{{ $errors->has('bidprice') ? ' has-error' : ''}}">
    {!! Form::label('bidprice', 'bidprice: ', ['class' => 'control-label']) !!}
    {!! Form::text('bidprice', null, ['class' => 'form-control']) !!}
    {!! $errors->first('bidprice', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('currentprice') ? ' has-error' : ''}}">
    {!! Form::label('currentprice', 'currentprice: ', ['class' => 'control-label']) !!}
    {!! Form::text('currentprice', null, ['class' => 'form-control']) !!}
    {!! $errors->first('currentprice', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('biddingtime') ? ' has-error' : ''}}">
    {!! Form::label('biddingtime', 'biddingtime: ', ['class' => 'control-label']) !!}
    {!! Form::date('biddingtime', null, ['class' => 'form-control']) !!}
    {!! $errors->first('biddingtime', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
