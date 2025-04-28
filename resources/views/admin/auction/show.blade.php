@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Role</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/auction') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/auction/' . $auction->auctionid . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/admin/auction', $auction->auctionid],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Role',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Startingtime</th><th>Endtime</th><th>Price</th><th>User</th><th>Product</th><th>ProductImage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$auction->auctionid }}</td> <td> {{ $auction->startingtime }} </td><td> {{ $auction->endtime }} </td><td> {{ $auction->price }} </td><td> {{ $auction->username }} </td><td> {{ $auction->productname }} </td><td><img src= {{ $auction->picture }} style = "background-size:cover; width:80px; height:80px;"/> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
