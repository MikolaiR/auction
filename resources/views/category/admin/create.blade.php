@extends('partials.admin')
@section('title', 'Admin Category Create')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'category.create'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Category', 'hasBack' => true, 'backTitle' =>
            'All Categories', 'backUrl' => route('admin.category.index')])

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Create Category</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <form class="card" action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">Name</label>
                                        <input type="text" class="form-control" id="exampleInputname" placeholder="Category Name" name="name">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">Slug</label>
                                        <input type="text" class="form-control" id="exampleInputname" placeholder="Category Slug" name="slug">
                                        <span class="text-danger">{{$errors->first('slug')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">Icon</label>
                                        <input class="form-control" name="icon" type="file" old="{{old('icon')}}">                                        
                                        <span class="text-danger">{{ $errors->first('icon') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">Image</label>
                                        <input class="form-control" name="image" type="file" old="{{old('image')}}">                                        
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    </div>
                                </div>                                 
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">Description</label>
                                        <input class="form-control" name="description" type="text" placeholder="Description">                                        
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                                                               
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success my-1">Save</button>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-danger my-1">Cancel</a>
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