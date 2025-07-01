<div class="form-wrapper">
    <form action="{{ route('user.payouts.request', $txnId) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-input-field name="amount" type="number" label="{{ __('Amount') }}" placeholder="{{ __('Enter Amount') }}" value="{{ $amount }}" :disabled="true" :readonly="true" />
                <span class="text-primary fs-6">{{ __('You will be charged') }} {{ $feePercentage }}% {{ __('fee on this amount. You will receive') }} {{ money($netAmount) }} {{ __('after fee deduction.') }}</span>
            </div>
            <div class="col-md-6">
                <label for="payment_method">{{ __('Payout Method') }} *</label>
                <select name="payment_method" id="payment_method">
                    <option value="">{{ __('Select Payout Method') }}</option>
                    @foreach ($payoutMethods as $method)
                        <option value="{{ $method->id }}">{{ $method->account_number .'-'. $method->bank_name }}</option>
                    @endforeach
                </select>
                @if($payoutMethods->count() < 1)
                <span class="text-danger">{{ __('You have not added any payout method yet.') }} <a class="fw-bolder" href="{{ route('user.payout-methods.create') }}">{{ __('Add Payout Method') }}</a></span>
                @endif
                <span class="text-danger">{{ $errors->first('payment_method') }}</span>
            </div>
            <x-textarea-field name="description" type="text" label="{{ __('Description') }}" placeholder="{{ __('Enter Description') }}" value="{{ old('description') }}" :admin="false" />
            <div class="col-12">
                <div class="button-group">
                   <button type="submit" class="account-btn"><i class="bi bi-cash-coin"></i> {{ __('Request Payout') }}</button>
                </div>
             </div>
        </div>
    </form>
</div>