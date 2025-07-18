@extends('partials.app')
@section('title', __('Payouts'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Payouts')])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payouts', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <x-payout-filter-component />
                    @if($payments->count() > 0)
                    <div class="table-wrapper">
                       <table class="eg-table order-table table mb-0">
                          <thead>
                             <tr>
                                <th>{{ __('Transaction ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Request Payout') }}</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td data-label="{{ __('Transaction ID') }}">{{ $payment->txn_id }} <a href="javascript:void(0)" onclick="copyToClipboard('{{ $payment->txn_id }}')" title="{{ __('Copy to clipboard') }}" data-bs-toggle="tooltip" data-bs-placement="top" class="copy-btn" data-clipboard-text="{{ $payment->txn_id }}"><i class="far fa-copy"></i></a>
                                <td data-label="{{ __('Amount') }}" class="text-green">{{ money($payment->amount) }}</td>
                                <td data-label="{{ __('Payment Method') }}" class="text-{{ $payment->gateway->color() }}">{{ $payment->gateway->label() }}</td>
                                <td data-label="{{ __('Status') }}" class="fw-bold text-{{ $payment->status->color() }}">{{ $payment->status->label() }}</td>
                                <td data-label="{{ __('Date') }}">{{ $payment->created_at->format('D M Y') }}</td>
                                @if($payment->status === \App\Enums\PaymentStatus::SUCCESS)
                                <td data-label="{{ __('Request Payout') }}"><a href="{{ route('user.payouts.show', $payment->txn_id) }}" class="eg-btn action-btn green text-white"><i class="fa-regular fa-money-simple-from-bracket"></i> {{ __('Request Payout') }}</a></td>
                                @else
                                <td data-label="{{ __('Request Payout') }}">{{ __('No Action') }}</td>
                                @endif
                            </tr>
                            @endforeach
                          </tbody>
                       </table>
                    </div>
                    {{ $payments->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="{{ __('empty') }}" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>{{ __('Sorry!') }}</strong> {{ __('You have not received any payments yet. Payments you receive will appear here.') }}</p>
                        </x-alert>
                    </div>
                    @endif
                 </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />
@push('scripts')
<script>
    function copyToClipboard(text) {
        var inputc = document.body.appendChild(document.createElement("input"));
        inputc.value = text;
        inputc.focus();
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
    }
</script>
@endpush

@endsection