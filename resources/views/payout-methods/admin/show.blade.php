@extends('partials.admin')
@section('title', __('Payout Method Details'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payout-methods'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Payout Method Details'), 'hasBack' => true, 'backTitle' => __('Payment Methods'), 'backUrl' => route('admin.payout-methods.index')])
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
                                                            <td class="fw-bold">{{ __('Account Name') }}</td>
                                                            <td> {{ $payoutMethod->account_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Account Number') }}</td>
                                                            <td> {{ $payoutMethod->account_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Bank Name / Bank Code') }}</td>
                                                            <td> {{ $payoutMethod->bank_name }} / {{
                                                                $payoutMethod->bank_code }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Country') }}</td>
                                                            <td><span>{{$payoutMethod->country->emoji}} {{
                                                                    $payoutMethod->country->name }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Method Owner') }}</td>
                                                            <td><span>{{$payoutMethod->user->name}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Method Owner Email') }}</td>
                                                            <td>{{ $payoutMethod->user->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Payouts Requested') }}</td>
                                                            <td class="d-flex justify-between"><span>{{ $payoutMethod->payouts->count() }} {{ __('counts') }} </span><a
                                                                    href="{{ route('admin.payouts.index', ['payout_method' => $payoutMethod->id]) }}">{{ __('See all payouts') }}</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Total Payouts Received') }}</td>
                                                            <td>{{ $payoutMethod->payouts->where('status',
                                                                \App\Enums\PayoutStatus::SUCCESS)->count() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Total Payouts Amount') }}</td>
                                                            <td>{{ money($payoutMethod->payouts->sum('amount')) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Total Payouts Fees') }}</td>
                                                            <td>{{ money($payoutMethod->payouts->sum('fee')) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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


@endpush