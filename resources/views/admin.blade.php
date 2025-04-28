@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                       Welcome to Mazadk admin's dashboard.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
