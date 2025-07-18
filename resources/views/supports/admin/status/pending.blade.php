@extends('partials.admin')
@section('title', __('Admin Pending Support'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'support.pending'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('All Pending Support'), 'hasBack' => true, 'backTitle' => __('All Support'), 'backUrl' => route('admin.support.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('All Pending Support') }}</h3>
                        </div>
                        <div class="">
                            <x-filter-admin-support-card />
                        </div>
                        <x-admin-support-table :supports="$pendingSupports" />
                    </div>
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