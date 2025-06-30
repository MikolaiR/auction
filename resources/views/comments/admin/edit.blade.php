@extends('partials.admin')
@section('title', __('Admin Edit Comment'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'blogs.comments'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Edit Comment'), 'hasBack' => true, 'backTitle' => __('All Comments'), 'backUrl' => route('admin.comments.index')])

            <div class="row">
                <div class="col-lg-12">
                    <form class="card" method="POST" action="{{ route('admin.comments.update', $comment->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-header">
                            <div class="card-title">{{ __('Edit Comment') }}</div>
                        </div>
                        <div class="card-body">
                            <x-text-area-field name="content" label="{{ __('Comment Content') }}" placeholder="{{ __('Enter Comment') }}" value="{{ $comment->content }}" :admin="true" />
                            <div class="row">
                                <label class="col-md-3 form-label mb-4">{{ __('Status *') }}:</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="{{ __('Select Status') }}">
                                       @foreach (\App\Enums\CommentStatus::all() as $status)
                                        <option value="{{ $status }}" {{ $comment->status == $status ? 'selected' : '' }}>{{ $status->label() }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                </div>
                            </div>
                            <!--End Row-->
                        </div>
                        <div class="card-footer">
                            <!--Row-->
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary">{{ __('Update Comment') }}</button>
                                    <a href="{{ route('admin.comments.index') }}" class="btn btn-default float-end">{{ __('Discard') }}</a>
                                </div>
                            </div>
                            <!--End Row-->
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