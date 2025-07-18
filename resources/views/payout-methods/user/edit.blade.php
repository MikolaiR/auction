@extends('partials.app')
@section('title', __('Edit Payout Method'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Edit Payout Method'), 'hasBack' => true, 'backUrl' => route('user.payout-methods.index'), 'routeItem' => $payoutMethod->bank_name, 'backTitle' => __('Payout Methods')])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payout-method', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <form class="w-100" action="{{ route('user.payout-methods.update', $payoutMethod->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-section">
                                    <h4>{{ __('Bank Information') }}</h4>
                                </div>
                                <div class="col-md-12">
                                   <select name="bank_code">
                                       <option value="">{{ __('Select Bank') }}</option>
                                       @foreach($banks as $bank)
                                        <option value="{{ $bank['code'] }}" @selected($payoutMethod->bank_code == $bank['code'])>{{ $bank['name'] }}</option>
                                        @endforeach
                                   </select>
                                   <span class="text-danger">{{ $errors->first('bank_code') }}</span>
                                </div>
                                <div class="form-section">
                                    <h4>{{ __('Account Information') }}</h4>
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="account_name" type="text" label="{{ __('Account Name') }}" placeholder="{{ __('Enter Account Name') }}" value="{{ $payoutMethod->account_name }}" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="account_number" type="number" label="{{ __('Account Number') }}" placeholder="{{ __('Enter Account Number') }}" value="{{ $payoutMethod->account_number }}" />
                                </div>
                            </div>
                            <button class="account-btn">{{ __('Update Payout Method') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@amplifiedhq/countries-atlas/dist/flags/css/flags.min.css" async defer>
@endpush

@endsection