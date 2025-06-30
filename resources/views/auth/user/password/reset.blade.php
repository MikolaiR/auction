@extends('partials.app')
@section('title', __('Reset Password'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Reset Password')])

<div class="login-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>{{ __('Reset Password') }}</h3>
                        <p>{{ __('Fill in the form below to reset your password.') }}</p>
                    </div>
                    <form class="w-100" action="{{ route('user.reset-password.handle') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="col-12">
                                <x-input-field name="password" type="password" label="{{ __('New Password') }}" placeholder="{{ __('Create A New Password') }}" />
                            </div>
                            <div class="col-12">
                                <x-input-field name="password_confirmation" type="password" label="{{ __('Confirm Password') }}" placeholder="{{ __('Confirm Password') }}" />
                            </div>
                        </div>
                        <button class="account-btn">{{ __('Reset Password') }}</button>
                    </form>
                    <div class="form-poicy-area">
                        <p>{{ __('By clicking the "reset password" button, you agree to Bazaar\'s') }} <a
                                href="#">{{ __('Terms & Conditions') }}</a> & <a href="#">{{ __('Privacy Policy') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection