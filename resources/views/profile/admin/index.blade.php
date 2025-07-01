@extends('partials.admin')
@section('title', __('Admin Profile Edit'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'dashboard'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Account Details'), 'hasBack' => true,
            'backTitle' =>
            __('Dashboard'), 'backUrl' => route('admin.dashboard')])

            <x-edit-profile-card />
        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection
@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

@endpush