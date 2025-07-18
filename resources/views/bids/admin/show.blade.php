@extends('partials.admin')
@section('title', __('Admin Bid Details'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'bids'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Bids Details'), 'hasBack' => true, 'backTitle' => __('Bids'), 'backUrl' => route('admin.bids.index')])
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card productdesc">
                        <div class="card-body">
                            <div class="panel panel-primary">
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active pt-5" id="tab6" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    <tr>
                                                        <td class="fw-bold">{{ __('Bidder Name') }}</td>
                                                        <td> {{  $bid->user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">{{ __('Ad Details') }}</td>
                                                        <td> <a href="{{ route('admin.ads.show', $bid->ad->slug) }}">{{ __('See linked ad:') }} {{ $bid->ad->title }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">{{ __('Ads Starting Price') }}</td>
                                                        <td> {{ money($bid->ad->price) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">{{ __('Bid Amount') }}</td>
                                                        <td> {{ money($bid->amount) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">{{ __('Bid Status') }}</td>
                                                        <td><span class="text-{{ is_null($bid->is_accepted) ? 'warning' : ($bid->is_accepted ? 'success' : 'danger') }}">{{is_null($bid->is_accepted) ? __('Pending') : ($bid->is_accepted ? __('Accepted') : __('Rejected'))}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">{{ __('Payment') }}</td>
                                                        <td>
                                                            @if($bid->payment?->exists())
                                                                <a href="{{ route('admin.payments.show', $bid->payment->txn_id) }}">{{ __('See linked payment here') }} - {{ $bid->payment->txn_id }}</a>
                                                            @else
                                                                <span class="text-danger">{{ __('No payment linked') }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection
@push('scripts')
<script>
    // Copy BidID
    function copyBidID(id) {
        const copyText = id;
        navigator.clipboard.writeText(copyText);
    }
</script>
    
@endpush