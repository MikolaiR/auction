@extends('partials.app')
@section('title', __('Login'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Login')])

<div class="login-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>{{ __('Log In') }}</h3>
                        <p>{{ __('New Member?') }} <a href="{{ route('user.register') }}">{{ __('register here') }}</a></p>
                    </div>
                    <form class="w-100" action="{{ route('user.login.handle') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <x-input-field name="email" type="email" label="{{ __('Enter Your Email') }}" placeholder="{{ __('Enter Your Email') }}" />
                            </div>
                            <div class="col-12">
                                <x-input-field name="password" type="password" label="{{ __('Enter Your Password') }}" placeholder="{{ __('Enter Your Password') }}" />
                            </div>
                            <div class="col-12">
                                <x-agree-checkbox class="form-agreement form-inner d-flex justify-content-between flex-wrap" id="html" name="terms" label="{{ __('I agree to the Terms & Policy') }}" forgotten="true" />
                            </div>
                        </div>
                        <button class="account-btn">{{ __('Log in') }}</button>
                    </form>
                    <div class="form-poicy-area">
                        <p>{{ __('By clicking the "signup" button, you create a Bazaar account, and you agree to Bazaar\'s') }} <a
                                href="#">{{ __('Terms & Conditions') }}</a> & <a href="#">{{ __('Privacy Policy') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection