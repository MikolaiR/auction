@extends('partials.app')
@section('title', __('Live Auction'))
@section('description', __('View current live auctions, and bid on items.'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Live Auction')])

<div class="live-auction-section pt-120 pb-120">
    <div class="container">
        <x-ad-filter-component/>
        <div class="row gy-4 mb-60 d-flex justify-content-center">
            @forelse ($ads as $ad)
                <x-ad-item-card :ad="$ad" type="default"/>
            @empty
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                    </div>
                    <x-alert type="warning">
                        <p class="text-center mb-0"><strong>{{ __('Sorry!') }}</strong> {{ __('No Auction found.') }}</p>
                    </x-alert>
                </div>
            @endforelse
        </div>
        <div class="row">
            {{ $ads->links('pagination.custom') }}
        </div>
    </div>
</div>

<x-metric-card />
@push('scripts')
<script src="/assets/js/countdown.js"></script>
@endpush
@endsection