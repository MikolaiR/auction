@extends('partials.admin')
@section('title', __('Admin Failed Payments'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payments.failed'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('All Failed Payments'), 'hasBack' => true, 'backTitle' => __('All Payments'), 'backUrl' => route('admin.payments.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                   <div class="card">
                      <div class="card-header">
                         <h3 class="card-title mb-0">{{ __('All Failed Payments') }}</h3>
                      </div>
                      <div class="">
                        <x-filter-admin-payment-card />
                    </div>
                    <x-admin-payment-table :payments="$failedPayments" />
                   </div>
                </div>
             </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection