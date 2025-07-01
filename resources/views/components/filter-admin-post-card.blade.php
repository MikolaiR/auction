<form class="row bid-filter">
    <div class="col-sm-12 col-md-8">
        <div id="data-table_filter" class="dataTables_filter">
            <label>{{ __('Search for a title, author, tags, etc:') }}</label>
            <input type="search" name="search" class="form-control form-control" placeholder="{{ __('Search by title, author, and tags...') }}" aria-controls="data-table" value="{{ request()->search }}">
            <span class="text-danger">{{ $errors->first('search') }}</span>
        </div>
     </div>
    <div class="col-sm-12 col-md-3">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>{{ __('Published') }}</label>
                <select name="published" id="published" class="form-control form-select select2" data-bs-placeholder="{{ __('Select Status') }}">
                    <option value="">{{ __('All') }}</option>
                    <option value="published" {{ request()->published == 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                    <option value="draft" {{ request()->published == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                </select>
                <span class="text-danger">{{ $errors->first('published') }}</span>
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