@extends('partials.app')
@section('title', __('Payments'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Payments')])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payments', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <x-payment-filter-component />
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
                                <th>{{ __('Bid') }}</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td data-label="{{ __('Transaction ID') }}">{{ $payment->txn_id }} <a href="javascript:void(0)" onclick="copyToClipboard('{{ $payment->txn_id }}')" title="{{ __('Copy to clipboard') }}" data-bs-toggle="tooltip" data-bs-placement="top" class="copy-btn" data-clipboard-text="{{ $payment->txn_id }}"><i class="far fa-copy"></i></a>
                                <td data-label="{{ __('Amount') }}" class="text-green">{{ money($payment->amount) }}</td>
                                <td data-label="{{ __('Payment Method') }}" class="text-{{ $payment->gateway->color() }}">{{ $payment->gateway->label() }}</td>
                                <td data-label="{{ __('Status') }}" class="fw-bold text-{{ $payment->status->color() }}">{{ $payment->status->label() }}</td>
                                <td data-label="{{ __('Date') }}">{{ $payment->created_at->format('d M, Y h:i A') }}</td>
                                <td data-label="{{ __('Bid') }}"><a href="{{ route('user.payments.show', $payment->txn_id) }}" class="eg-btn action-btn green text-white"><i class="fas fa-eye"></i> {{ __('View') }}</a></td>
                            </tr>
                            @endforeach
                          </tbody>
                       </table>
                    </div>
                    {{ $payments->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>{{ __('Sorry!') }}</strong> {{ __('You have no ad payments yet. Ads you purchase will appear here.') }}</p>
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