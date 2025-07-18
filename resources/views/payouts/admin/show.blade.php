@extends('partials.admin')
@section('title', __('Payout Details') . ' - ' . $payout->pyt_token)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payouts'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Payout Details'), 'hasBack' => true, 'backTitle' => __('All Payments'), 'backUrl' => route('admin.payments.index')])
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
                                                            <td class="fw-bold">{{ __('Payout Token') }}</td>
                                                            <td> <i class="fa-regular fa-money-from-bracket"></i>  {{ $payout->pyt_token }} <i class="fa-regular fa-copy copy-text" onclick="copyTransactionID('{{ $payout->pyt_token }}')"></i>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Payout Owner') }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="avatar bradius"
                                                                       style="background-image: url({{$payout->user->avatar}})"></span>
                                                                    <div
                                                                       class="ms-3 mt-0 d-block">
                                                                       <a href="{{ route('admin.users.show', $payout->user->id) }}"
                                                                          class="mb-0 fs-14 fw-semibold text-info">
                                                                            {{ $payout->user->name }}
                                                                       </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Amount') }}</td>
                                                            <td> {{ money($payout->amount) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Fee') }}</td>
                                                            <td> {{ money($payout->fee) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Status') }}</td>
                                                            <td><span class="bg-{{ $payout->status->color() }} badge text-uppercase px-2">{{ $payout->status->label() }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Gateway') }}</td>
                                                            @if($payout->gateway)
                                                            <td> <span class="badge text-uppercase bg-{{ $payout->gateway->color() }}">{{ $payout->gateway->label() }}</span></td>
                                                            @else
                                                            <td> <span class="badge text-uppercase bg-danger">{{ __('No gateway, payout has not been processed') }}</span></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Description') }}</td>
                                                            <td> @if($payout->description) {!! $payout->description !!} @else <span class="text-danger">{{ __('No description') }}</span> @endif</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Linked Payment') }}</td>
                                                            <td> 
                                                                @if($payout->payment?->exists())
                                                                    <a href="{{ route('admin.payments.show', $payout->payment->txn_id) }}">{{ __('See linked payment here') }} - {{ money($payout->payment->amount) }}</a>
                                                                @else
                                                                    <span class="text-danger">{{ __('No payment linked') }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Linked Payout Method') }}</td>
                                                            <td> 
                                                                @if($payout->payoutMethod?->exists())
                                                                    <a href="{{ route('admin.payout-methods.show', $payout->payoutMethod->id) }}">{{ __('See linked payout method here') }} ({{ $payout->payoutMethod->bank_name }} - {{ $payout->payoutMethod->account_name }} - {{ $payout->payoutMethod->account_number }})</a>
                                                                @else
                                                                    <span class="text-danger">{{ __('No payout method linked') }}</span>
                                                                @endif
                                                            </td>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Paid At') }}</td>
                                                            <td> {{ $payout->paid_at?->format('d M Y h:i A') ?? __('Not Paid') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">{{ __('Created At') }}</td>
                                                            <td> {{ $payout->created_at->format('d M Y h:i A') }}</td>
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
<script>
    function copyTransactionID(txn_id) {
        navigator.clipboard.writeText(txn_id);
        alert('{{ __("Payout Token copied to clipboard") }}');
    }
</script>
@endpush