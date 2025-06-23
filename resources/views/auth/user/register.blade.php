@extends('partials.app')
@section('title', 'Register')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Register'])

<div class="signup-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>Sign Up</h3>
                        <p>Do you already have an account? <a href="{{ route('user.login') }}">Log in here</a></p>
                    </div>
                    <x-auth.register-form :typeOwners="$typeOwners" :regions="$regions"/>
                    <div class="form-poicy-area">
                        <p>By clicking the "signup" button, you create a Bazaar account, and you agree to Bazaar's <a
                                href="#">Terms &amp; Conditions</a> &amp; <a href="#">Privacy Policy.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection
