<div class="form-wrapper">
    <form action="{{ route('user.pay', $bid->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-input-field name="amount" type="number" label="{{ __('Amount') }}" placeholder="{{ __('Enter Amount') }}" value="{{ $bid->amount }}" :disabled="true" :readonly="true" />
            </div>
            <div class="col-md-6">
                <label for="payment_method">{{ __('Payment Method') }} *</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    @foreach ($methods as $method)
                        <option value="{{ $method->value }}">{{ $method->label() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <div class="button-group">
                   <button type="submit" class="account-btn"><i class="bi bi-credit-card-2-front-fill"></i> {{ __('Pay Now') }}</button>
                </div>
             </div>
        </div>
    </form>
</div>