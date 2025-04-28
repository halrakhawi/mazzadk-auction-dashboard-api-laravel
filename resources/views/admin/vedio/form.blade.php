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
<div class="form-group{{ $errors->has('details') ? 'has-error' : ''}}">
    {!! Form::label('details', 'details', ['class' => 'control-label']) !!}
    {!! Form::text('details', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('done') ? 'has-error' : ''}}">
        {!! Form::label('done', 'done', ['class' => 'control-label']) !!}
    {!! Form::text('done', null,('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('done', '<p class="help-block">:message</p>') !!}
    </div>
    
        <form action="{{ route('addvedio') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="url" class="form-control">
                </div>
        
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        
        </div>
        </div>
        </form>