@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">bids</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/bid/create') }}" class="btn btn-success btn-sm" title="Add New bid">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/bid', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
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
                                @foreach($bids as $item)
                                    <tr>
                                        <td>{{ $item->bidid }}</td>
                                        <td><a href="{{ url('/admin/bid', $item->bidid) }}">{{ $item->product_id }}</a></td><td>{{ $item->username }}</td><td>{{ $item->bidprice }}</td><td>{{ $item->currentprice }}</td><td>{{ $item->biddingtime }}</td>
                                        <td>
                                            <a href="{{ url('/admin/bid/' . $item->bidid) }}" title="View bid"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/bid/' . $item->bidid . '/edit') }}" title="Edit bid"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/bid', $item->bidid],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete bid',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!--div class="pagination"> {--!! $auction->(['search' => Request::get('search')])->render() !!} </div>
                        </div-->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
