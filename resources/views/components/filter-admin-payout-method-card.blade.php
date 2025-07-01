<form class="row bid-filter">
    <div class="col-sm-12 col-md-3">
        <div id="data-table_filter" class="dataTables_filter">
            <label>{{ __('Search for a user') }}</label>
            <input type="search" name="user_id" class="form-control form-control" placeholder="{{ __('Search user id...') }}" aria-controls="data-table" value="{{ request()->user_id }}">
            <span class="text-danger">{{ $errors->first('user_id') }}</span>
        </div>
     </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>{{ __('Country') }}</label>
                <select name="country_id" id="status" class="form-control form-select select2" data-bs-placeholder="{{ __('Select Status') }}">
                    <option value="">{{ __('All countries') }}</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @selected($country->id == request()->country_id)>{{ $country->emoji }} {{ $country->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>{{ __('Bank') }}</label>
                <select name="bank_code" id="status" class="form-control form-select select2" data-bs-placeholder="{{ __('Select Status') }}">
                    <option value="">{{ __('All') }}</option>
                    @foreach ($bankCodes as $bankCode)
                    <option value="{{$bankCode['code']}}" @if (request()->bank_code === $bankCode['code']) selected @endif>{{$bankCode['name']}}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('bank_code') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="row mb-4">
            <div class="col-sm-6 col-md-6">
                <label>{{ __('Date from:') }}</label>
                <input type="date" class="form-control" placeholder="{{ __('Select date from') }}" name="date_from" value="{{ request()->date_from }}" id="">
                <span class="text-danger">{{ $errors->first('date_from') }}</span>
            </div>
            <div class="col-sm-6 col-md-6">
                <label>{{ __('Date to:') }}</label>
                <input type="date" class="form-control" placeholder="{{ __('Select date to') }}" name="date_to" value="{{ request()->date_to }}" id="">
                <span class="text-danger">{{ $errors->first('date_to') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-1 align-self-end">
        <div class="row mb-4">
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="{{ __('Filter') }}">
            </div>
        </div>
    </div>
</form>