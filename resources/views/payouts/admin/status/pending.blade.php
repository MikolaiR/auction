@extends('partials.admin')
@section('title', __('Admin Pending Payouts'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payouts.pending'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('All Pending Payouts'), 'hasBack' => true, 'backTitle' => __('All Payouts'), 'backUrl' => route('admin.payouts.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('All Pending Payouts') }}</h3>
                        </div>
                        <div class="">
                            <x-filter-admin-payout-card />
                        </div>
                        <x-admin-payout-table :payouts="$pendingPayouts" />
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