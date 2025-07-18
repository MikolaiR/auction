<div class="row mb-4">
    <label class="col-md-3 form-label">{{ __('Status :') }}</label>
    <div class="col-md-9">
        <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="{{ __('Select Status') }}">
            <option value="">{{ __('Select Status') }}</option>
            @foreach ($statuses as $status)
            <option value="{{ $status }}" {{ $selectedStatus == $status ? 'selected' : '' }}>{{ $status->label() }}</option>
            @endforeach
        </select>
    </div>
</div>