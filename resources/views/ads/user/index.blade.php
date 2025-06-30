@extends('partials.app')
@section('title', __('Ads Listing'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Ads Listing')])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'ads', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area">
                       <h3>{{ __('Auction Listing') }}</h3>
                       <form class="d-flex align-items-center">
                       <select name="status">
                        <option value=""> {{ __('Show: All Listing (Filter)') }}</option>
                        <option value="pending" @selected(request()->status == 'pending')>{{ __('Show: Pending Listing') }}</option>
                        <option value="active" @selected(request()->status == 'active')>{{ __('Show: Active Listing') }}</option>
                        <option value="upcoming" @selected(request()->status == 'upcoming')>{{ __('Show: Upcoming Listing') }}</option>
                        <option value="expired" @selected(request()->status == 'expired')>{{ __('Show: Expired Listing') }}</option>
                        <option value="rejected" @selected(request()->status == 'rejected')>{{ __('Show: Rejected Listing') }}</option>
                     </select>
                     <button type="submit" class="filter-btn bg-dark text-white ml-2">{{ __('Filter') }}</button>
                    </form>
                    </div>
                    @if($ads->count() > 0)
                    <div class="table-wrapper">
                       <table class="eg-table order-table table mb-0">
                          <thead>
                             <tr>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Auction Title') }}</th>
                                <th>{{ __('Starting Price') }}</th>
                                <th>{{ __('Timeframe') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($ads as $ad)
                            <tr>
                                <td data-label="{{ __('Image') }}"><img alt="image" src="{{ $ad->media->first()->url }}" class="img-fluid"></td>
                                <td data-label="{{ __('Ads Title') }}">{{ shorten_chars($ad->title, 20) }}</td>
                                <td data-label="{{ __('Starting Price') }}">{{ money($ad->price) }}</td>
                                <td data-label="{{ __('Timeframe') }}">{{ $ad->started_at->format('d M Y') }} - {{ $ad->expired_at->format('d M Y') }}</td>
                                <td data-label="{{ __('Status') }}" class="text-{{ $ad->status->color() }}">{{ $ad->status->label() }}</td>
                                <td data-label="{{ __('Action') }}">
                                    <a href="{{ route('user.ads.show', $ad->slug) }}" class="eg-btn action-btn green text-white"><i class="bi bi-eye-fill"></i> {{ __('View') }}</a>
                                    <a href="{{ route('user.ads.edit', $ad->slug) }}" class="eg-btn action-btn text-dark edit-btn"><i class="bi bi-pencil-fill"></i> {{ __('Edit') }}</a>
                                </td>
                             </tr>
                            @endforeach
                          </tbody>
                       </table>
                    </div>
                    {{ $ads->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>{{ __('Sorry!') }}</strong> {{ __('You have no auction listing currently. To add a listing, click') }} <a href="{{ route('add-listing') }}" class="fw-bold">{{ __('here') }}</a>.</p>
                        </x-alert>
                    </div>
                    @endif
                 </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection