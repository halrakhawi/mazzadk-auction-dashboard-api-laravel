@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Auction</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/auction/create') }}" class="btn btn-success btn-sm" title="Add New Role">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/auction', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
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
                                        <th>ID</th><th>Startingtime</th><th>Endtime</th><th>Price</th><th>User</th><th>Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($auction as $item)
                                    <tr>
                                        
                                        <td><a href="{{ url('/admin/auction', $item->auctionid) }}">{{ $item->auctionid }}</a></td><td>{{ $item->startingtime }}</td><td>{{ $item->endtime }}</td><td>{{ $item->price }}</td><td>{{ $item->username }}</td><td>{{ $item->productname }}</td>
                                        <td>
                                            <a href="{{ url('/admin/auction/' . $item->auctionid) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/auction/' . $item->auctionid . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/auction', $item->auctionid],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Role',
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
