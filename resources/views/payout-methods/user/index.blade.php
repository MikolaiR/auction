@extends('partials.app')
@section('title', __('Payout Methods'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Payouts')])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payout-method', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area pb-4">
                        <h2>{{ __('Payout Method') }}</h2>
                        @if($payoutMethods->count() < 3)
                        <a href="{{ route('user.payout-methods.create')}}" class="filter-btn btn--primary btn--md">{{ __('Create Payout Method') }}</a>
                        @endif
                    </div>
                    @if($payoutMethods->count() > 0)
                    <div class="table-wrapper">
                       <table class="eg-table order-table table mb-0">
                          <thead>
                             <tr>
                                <th>{{ __('Bank Name') }}</th>
                                <th>{{ __('Account Name') }}</th>
                                <th>{{ __('Account Number') }}</th>
                                <th>{{ __('Date Created') }}</th>
                                <th class="border-bottom-0">{{ __('Action') }}</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($payoutMethods as $payout)
                            <tr>
                                <td data-label="{{ __('Bank Name') }}">{{ $payout->bank_name }}</td>
                                <td data-label="{{ __('Account Name') }}">{{ $payout->account_name }}</td>
                                <td data-label="{{ __('Account Number') }}">{{ $payout->account_number }}</td>
                                <td data-label="{{ __('Date Created') }}">{{ $payout->created_at->format('D M Y') }}</td>
                                <td data-label="{{ __('Action') }}" class="d-flex">
                                    <a href="{{ route('user.payout-methods.edit', $payout->id) }}" class="eg-btn action-btn green text-white"><i class="fa-regular fa-edit"></i> {{ __('Edit') }}</a>
                                    <form action="{{ route('user.payout-methods.destroy', $payout->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="eg-btn action-btn green text-white bg-danger ml-2"><i class="fa-regular fa-trash"></i> {{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                       </table>
                    </div>
                    {{ $payoutMethods->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="{{ __('empty') }}" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>{{ __('Sorry!') }}</strong> {{ __('You have not have any payout method yet. Payout methods you create will appear here.') }}</p>
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