<form class="row bid-filter">
    <div class="col-sm-12 col-md-7">
        <div id="data-table_filter" class="dataTables_filter">
            <label>{{ __('Search for email, name, email, phone, id...') }}</label>
            <input type="search" name="search" class="form-control form-control" placeholder="{{ __('Search for email, name, email, phone, id...') }}" aria-controls="data-table" value="{{ request()->search }}">
            <span class="text-danger">{{ $errors->first('search') }}</span>
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