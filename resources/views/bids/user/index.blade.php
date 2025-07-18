@extends('partials.app')
@section('title', __('My Bids'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('My Bids')])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'bidding', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area">
                    <h3>{{ __('My Bids') }}</h3>
                    <form class="d-flex align-items-center">
                        <select name="sort">
                         <option value=""> {{ __('Sort: All Bids (Sort ASC/DESC)') }}</option>
                         <option value="created+asc" @selected(request()->sort == 'created+asc')>{{ __('Sort By: Created At (ASC)') }}</option>
                         <option value="created+desc" @selected(request()->sort == 'created+desc')>{{ __('Sort By: Created At (DESC)') }}</option>
                         <option value="amount+asc" @selected(request()->sort == 'amount+asc')>{{ __('Sort By: Bid Amount (ASC)') }}</option>
                         <option value="amount+desc" @selected(request()->sort == 'amount+desc')>{{ __('Sort By: Bid Amount (DESC)') }}</option>
                         <option value="start+asc" @selected(request()->sort == 'start+asc')>{{ __('Sort By : Start Date (ASC)') }}</option>
                         <option value="start+desc" @selected(request()->sort == 'start+desc')>{{ __('Sort By : Start Date (DESC)') }}</option>
                         <option value="end+asc" @selected(request()->sort == 'end+asc')>{{ __('Show: End Date (ASC)') }}</option>
                         <option value="end+desc" @selected(request()->sort == 'end+desc')>{{ __('Show: End Date (DESC)') }}</option>
                      </select>
                      <button type="submit" class="filter-btn bg-dark text-white ml-2">{{ __('Sort') }}</button>
                     </form>
                    </div>
                    @if($bids->count() > 0)
                    <div class="table-wrapper">
                        <table class="eg-table order-table table mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __('Ad Title') }}</th>
                                    <th>{{ __('Timeframe') }}</th>
                                    <th>{{ __('Bid Amount') }}</th>
                                    <th>{{ __('Ad Status') }}</th>
                                    <th>{{ __('Bid Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bids as $bid)
                                <tr>
                                    <td data-label="{{ __('Ad Title') }}"><a href="{{ route('auction-details', $bid->ad->slug) }}" class="text-dark title-hover">{{ shorten_chars($bid->ad->title, 20) }}</a></td>
                                    <td data-label="{{ __('Timeframe') }}">{{ $bid->ad->started_at->format('d M Y') }} - {{ $bid->ad->expired_at->format('d M Y') }}</td>
                                    <td data-label="{{ __('Bid Amount') }}">{{ money($bid->amount) }}</td>
                                    <td data-label="{{ __('Status') }}" class="text-{{ $bid->ad->status->color() }}">{{ $bid->ad->status->label() }}</td>
                                    <td data-label="{{ __('Bid Status') }}" class="text-{{ is_null($bid->is_accepted) ? 'warning' : ( $bid->is_accepted ? 'success' : 'danger' ) }}">{{ is_null($bid->is_accepted) ? __('Pending') : ( $bid->is_accepted ? __('Accepted') : __('Rejected') ) }}</td>
                                    <td data-label="{{ __('Action') }}">
                                        @if($bid->is_accepted)
                                            @if($bid->payment?->status === \App\Enums\PaymentStatus::SUCCESS)
                                            <a href="{{ route('user.listing-bids.show', $bid->id) }}" class="eg-btn action-btn green text-white bg-secondary"><i class="bi bi-credit-card-2-front-fill"></i> {{ __('Paid') }}</a>
                                            @else
                                            <a href="{{ route('user.listing-bids.show', $bid->id) }}" class="eg-btn action-btn green text-white"><i class="bi bi-credit-card-2-front-fill"></i> {{ __('Pay Now') }}</a>
                                            @endif
                                        @else
                                        {{ __('No Action') }}
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $bids->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>{{ __('Sorry!') }}</strong> {{ __('You have no bids on any listing currently. To bid on a listing, click') }} <a href="{{ route('live-auction') }}" class="fw-bold">{{ __('here') }}</a>.</p>
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