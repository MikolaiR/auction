@extends('partials.app')
@section('title', __('Report Listing'))
@section('description', __('Report listing if you think it is inappropriate.'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Report Listing'), 'hasBack' => true, 'backUrl' => route('auction-details', $ad->slug), 'backTitle' => __('Ads Listing'), 'routeItem' => $ad->title])

<div class="pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <form class="w-100" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-section">
                                <h4>{{ __('Report Listing') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="reason" type="text" label="{{ __('Report Ad Reason') }}" placeholder="{{ __('Enter Reason') }}" value="{{ old('reason') }}" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="email" type="text" label="{{ __('Report Email') }}" placeholder="{{ __('Enter Email') }}" value="{{ old('email') }}" />
                            </div>
                            <div class="col-md-12">
                                <x-textarea-field name="description" label="{{ __('Ad Report Description') }}"
                                    placeholder="{{ __('Enter Reason') }}" value="{{ old('description') }}" :admin="false" />
                            </div>
                            <div class="col-md-12">
                                <x-agree-checkbox
                                    class="form-agreement form-inner d-flex justify-content-between flex-wrap" id="html"
                                    name="terms" label="{{ __('I agree to the Terms & Policy') }}" />
                            </div>
                        </div>
                        {!! LaraCaptcha::display() !!}
                        <button class="account-btn">{{ __('Report Listing') }}</button>
                    </form>
                    <div class="form-poicy-area">
                        <p>{!! __('By clicking the "report listing" button, you are reporting this listing as inappropriate. Please read Auction Engine\'s <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy.</a>') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<x-metric-card />

@endsection
@push('scripts')
{!! LaraCaptcha::script() !!}
@endpush