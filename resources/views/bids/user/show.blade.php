@extends('partials.app')
@section('title', __('Listing Bid'). ' - '.$bid->ad->title)
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Listing Bid'), 'hasBack' => true, 'backUrl' => route('user.listing-bids'), 'backTitle' => __('My Bids'), 'routeItem' => $bid->ad->title])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'bidding', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="ad-listing-wrapper">
                        <div class="row gy-2 d-flex">
                            <div
                                class="col-xl-6 col-lg-7 d-flex flex-row align-items-start justify-content-lg-start justify-content-center flex-md-nowrap flex-wrap gap-4">
                                <ul class="nav small-image-list d-flex flex-md-column flex-row justify-content-center gap-4  wow fadeInDown"
                                    data-wow-duration="1.5s" data-wow-delay=".4s"
                                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInDown;">
                                    @foreach ($bid->ad->media as $media)
                                    <li class="nav-item">
                                        <div id="details-img{{ $loop->index + 1 }}" data-bs-toggle="pill" data-bs-target="#gallery-img{{ $loop->index + 1 }}"
                                            aria-controls="gallery-img{{ $loop->index + 1 }}" class="">
                                            <img alt="image" src="{{ $media->url }}" class="img-fluid">
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mb-4 d-flex justify-content-lg-start justify-content-center  wow fadeInUp"
                                    data-wow-duration="1.5s" data-wow-delay=".4s"
                                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                                    @foreach ($bid->ad->media as $media)
                                    <div class="tab-pane big-image fade {{ $loop->index == 0 ? 'active show' : '' }}" id="gallery-img{{ $loop->index + 1 }}">
                                        <div class="auction-gallery-timer d-flex align-items-center justify-content-center">
                                            <h3>{{ __('Ad Images') }}</h3>
                                        </div>
                                        <img alt="image" src="{{ $media->url }}" class="img-fluid">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5">
                                <div class="ad-listing-item">
                                    <span>{{ __('Title:') }}</span>
                                    <h3>{{ $bid->ad->title }}</h3>
                                </div>
                                <div class="ad-listing-item">
                                    <span>{{ __('Starting Price:') }}</span>
                                    <h5>{{ money($bid->ad->price) }}</h5>
                                </div>
                                <div class="ad-listing-item">
                                    <span>{{ __('Timeframe:') }}</span>
                                    <p>{{ $bid->ad->started_at->format('d M Y h:i A') }} - {{ $bid->ad->expired_at->format('d M Y h:i A') }}</p>
                                </div>
                                <div class="row d-flex">
                                    <div class="ad-listing-item col-6">
                                        <span>{{ __('Ad Status:') }}</span>
                                        <p class="text-{{ $bid->ad->status->color() }}">{{ $bid->ad->status->label() }}</p>
                                    </div>
                                    <div class="ad-listing-item col-6">
                                        <span>{{ __('Bid Status:') }}</span>
                                        <p class="text-{{ is_null($bid->is_accepted) ? 'warning' : ( $bid->is_accepted ? 'success' : 'danger' ) }}">{{ is_null($bid->is_accepted) ? __('Pending') : ( $bid->is_accepted ? __('Accepted') : __('Rejected') ) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ad-listing-wrapper mt-4">
                        <h3>{{ __('Ad Seller Details:') }}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Seller Name') }}</th>
                                    <th scope="col">{{ __('Seller Email') }}</th>
                                    <th scope="col">{{ __('Seller Phone') }}</th>
                                    <th scope="col">{{ __('Seller Address') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $bid->ad->seller_name ?? __('Not Available') }}</td>
                                    <td>{{ $bid->ad->seller_email ?? __('Not Available') }}</td>
                                    <td>{{ $bid->ad->seller_mobile ?? __('Not Available') }}</td>
                                    <td>{{ $bid->ad->seller_address ?? __('Not Available') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if($bid->is_accepted)
                    <div class="ad-listing-wrapper mt-4">
                        <h3>{{ __('My Winning Bid:') }}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Bidder Name') }}</th>
                                    <th scope="col">{{ __('Bidder Email') }}</th>
                                    <th scope="col">{{ __('Bidder Phone') }}</th>
                                    <th scope="col">{{ __('Bid Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $bid->user->name }}</td>
                                    <td>{{ $bid->user->email }}</td>
                                    <td>{{ $bid->user->mobile }}</td>
                                    <td>{{ money($bid->amount) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="ad-listing-wrapper mt-4">
                        <h3>{{ __('My Winning Bid:') }}</h3>
                        <p class="text-danger text-center">{{ __('No Winning Bid') }}</p>
                    </div>
                    @endif
                    @if($bid->is_accepted && $bid->payment?->status === \App\Enums\PaymentStatus::SUCCESS)
                    <div class="ad-listing-wrapper mt-4">
                        <h3>{{ __('Payment Details:') }}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Payment ID') }}</th>
                                    <th scope="col">{{ __('Payment Method') }}</th>
                                    <th scope="col">{{ __('Payment Status') }}</th>
                                    <th scope="col">{{ __('Payment Amount') }}</th>
                                    <th scope="col">{{ __('Payment Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $bid->payment->txn_id }}</td>
                                    <td>{{ $bid->payment->gateway->label() }}</td>
                                    <td class="text-{{ $bid->payment->status->color() }} fw-bold text-uppercase">{{ $bid->payment->status->label() }}</td>
                                    <td>{{ money($bid->payment->amount) }}</td>
                                    <td>{{ $bid->payment->created_at->format('d M Y h:i A') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @elseif($bid->is_accepted && $bid->payment?->status === \App\Enums\PaymentStatus::PENDING)
                    <div class="ad-listing-wrapper mt-4">
                        <h3>{{ __('Payment Details:') }}</h3>
                        <p class="text-danger text-center">{{ __('Payment Pending') }}</p>
                        <div class="d-flex justify-content-center mt-4 ">
                            <x-payable-form :bid="$bid" />
                        </div>
                    </div>
                    @elseif($bid->is_accepted && $bid->payment?->status === \App\Enums\PaymentStatus::FAILED)
                    <div class="ad-listing-wrapper mt-4">
                        <h3>{{ __('Payment Details:') }}</h3>
                        <p class="text-danger text-center">{{ __('Payment Failed') }}</p>
                        <div class="d-flex justify-content-center mt-4 ">
                            <x-payable-form :bid="$bid" />
                        </div>
                    </div>
                    @elseif ($bid->is_accepted && !$bid->payment)
                    <div class="ad-listing-wrapper mt-4">
                        <h3>{{ __('Payment Details:') }}</h3>
                        <p class="text-danger text-center">{{ __('No Payment Details') }}</p>
                        <div class="d-flex justify-content-center mt-4 ">
                            <x-payable-form :bid="$bid"/>
                        </div>
                    </div>
                    @endif
                </div>
          </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection