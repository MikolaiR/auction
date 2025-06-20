@extends('partials.admin')
@section('title', 'Admin Auction Type Create')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'auctiontype.create'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Auction Types', 'hasBack' => true, 'backTitle' =>
            'All Auction Types', 'backUrl' => route('admin.auctiontype.index')])

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Create Auction Type</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <form class="card" action="{{ route('admin.auctiontype.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">Type</label>
                                        <input type="text" class="form-control" id="exampleInputname" placeholder="Auction Type" name="name">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success my-1">Save</button>
                            <a href="{{ route('admin.auctiontype.index') }}" class="btn btn-danger my-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection
@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

@endpush