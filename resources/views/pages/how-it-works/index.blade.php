@extends('partials.app')
@section('title', __('How it works'))
@section('description', __('How to auction on our platform'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('How it works')])

 <div class="how-work-section pt-120 pb-120">
    <div class="container">
       <div class="row g-4 mb-60">
          <div class="col-xl-6 col-lg-6">
             <div class="how-work-content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <span>{{ __('01.') }}</span>
                <h3>{{ __('Register Now & Start Selling Your Things') }}</h3>
                <p class="para">{{ __('Create your free account to start participating in government and private auctions across India. Simply sign up using your Aadhaar/PAN details, complete KYC, and deposit your Earnest Money Deposit (EMD) for the property or asset you\'re interested in.') }}</p>
                
                <a href="{{ route('user.register') }}" class="eg-btn btn--primary btn--md">{{ __('Register Account') }}</a>
             </div>
          </div>
          <div class="col-xl-6 col-lg-6 d-flex justify-content-lg-end justify-content-center">
             <div class="how-work-img wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                <img alt="image" src="assets/images/bg/how-work1.png" class="work-img">
             </div>
          </div>
       </div>
       <div class="row g-4 mb-60">
          <div class="col-xl-6 col-lg-6 d-flex justify-content-lg-start justify-content-center order-lg-1 order-2">
             <div class="how-work-img wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                <img alt="image" src="assets/images/bg/how-work2.png" class="work-img">
             </div>
          </div>
          <div class="col-xl-6 col-lg-6 order-lg-2 order-1">
             <div class="how-work-content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <span>{{ __('02.') }}</span>
                <h3>{{ __('Select Your Item') }}</h3>
                <p class="para">{{ __('Browse live auctions from real estate, vehicles, scrap, and more. Place secure online bids from anywhere using your desktop or mobile. Auctions are transparent and follow the rules set by Indian government auction portals like MSTC, eAuction India, and eBkray.') }}</p>
                <a href="#" class="eg-btn btn--primary btn--md">{{ __('Add Your Item') }}</a>
             </div>
          </div>
       </div>
       <div class="row g-4">
          <div class="col-xl-6 col-lg-6">
             <div class="how-work-content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <span>{{ __('03.') }}</span>
                <h3>{{ __('Purchase Items') }}</h3>
                <p class="para">{{ __('If you\'re the highest bidder, complete the payment within the stipulated timeline as per the auction terms. You\'ll receive official documentation directly from the auction authority. Our support team helps guide you through documentation and registration under Indian law.') }}</p>
                <a href="{{ route('live-auction') }}" class="eg-btn btn--primary btn--md">{{ __('Purchase Item') }}</a>
             </div>
          </div>
          <div class="col-xl-6 col-lg-6 d-flex justify-content-lg-end justify-content-center">
             <div class="how-work-img wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                <img alt="image" src="assets/images/bg/how-work3.png" class="work-img">
             </div>
          </div>
       </div>
    </div>
 </div>
 
@include('layouts.why-choose-us')

<x-metric-card />

@endsection
