@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">bid</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/bid') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/bid/' . $bid->bidid . '/edit') }}" title="Edit bid"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/admin/bid', $bid->bidid],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete bid',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>BidID</th><th>product_id</th><th>User</th><th>bidprice</th><th>currentprice</th><th>biddingtime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $bid->bidid }}</td><td>{{ $bid->product_id }}</td> <td>{{ $bid->username }}</td><td>{{ $bid->bidprice }}</td><td>{{ $bid->currentprice }}</td><td>{{ $bid->biddingtime }}</td>
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