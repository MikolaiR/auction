@extends('partials.app')

@section('title', __('Accreditation'))
@section('content')

    @include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Accreditation')])

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ __('Complete Your Accreditation') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (isset($userData) && $userData->status === 'rejected')
                            <div class="alert alert-warning">
                                <h5>{{ __('Your previous submission was rejected') }}</h5>
                                <p><strong>{{ __('Reason') }}:</strong> {{ $userData->admin_comment }}</p>
                                <p>{{ __('Please update your information and resubmit.') }}</p>
                            </div>
                        @endif

                        <form id="accreditation-form" method="POST" action="{{ route('user.accreditation.submit') }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <h5 class="text-center">{{ __('Ownership Type') }}</h5>
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="btn-group type-owner-buttons" role="group">
                                        <input type="hidden" name="type_owner" id="type-owner-input"
                                               value="{{ old('type_owner', $userData->type_owner ?? 0) }}">

                                        <button type="button"
                                                class="btn {{ (old('type_owner', $userData->type_owner ?? 0) == 0) ? 'btn-primary' : 'btn-outline-primary' }}"
                                                data-type="0">{{ __('Individual') }}</button>
                                        <button type="button"
                                                class="btn {{ (old('type_owner', $userData->type_owner ?? 0) == 1) ? 'btn-primary' : 'btn-outline-primary' }}"
                                                data-type="1">{{ __('Sole Proprietor') }}</button>
                                        <button type="button"
                                                class="btn {{ (old('type_owner', $userData->type_owner ?? 0) == 2) ? 'btn-primary' : 'btn-outline-primary' }}"
                                                data-type="2">{{ __('Company') }}</button>
                                    </div>
                                </div>
                                @error('type_owner')
                                <div class="text-danger mt-1 text-center">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Common fields -->
                            <div class="common-fields">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fio">{{ __('Full Name') }}</label>
                                            <input type="text" name="fio" id="fio"
                                                class="form-control @error('fio') is-invalid @enderror"
                                                value="{{ old('fio', $userData->fio ?? '') }}" required>
                                            @error('fio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('Phone') }}</label>
                                            <input type="text" name="phone" id="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone', $userData->phone ?? '') }}" required>
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $userData->email ?? '') }}" required>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="region">{{ __('Region') }}</label>
                                            <select name="region" id="region"
                                                class="form-control @error('region') is-invalid @enderror" required>
                                                <option value="">{{ __('Select Region') }}</option>
                                                @foreach($regions as $region)
                                                    <option value="{{ $region->id }}" {{ (old('region', $userData->region ?? '') == $region->id) ? 'selected' : '' }}>
                                                        {{ $region->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('region')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">{{ __('Address') }}</label>
                                            <input type="text" name="address" id="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="{{ old('address', $userData->address ?? '') }}" required>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Individual fields -->
                            <div id="individual-fields" class="owner-type-section"
                                 style="{{ (old('type_owner', $userData->type_owner ?? 0) == 0) ? 'display: block;' : 'display: none;' }}">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" id="first_name"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   value="{{ old('first_name', $userData->first_name ?? '') }}"
                                                   required>
                                            @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" id="last_name"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   value="{{ old('last_name', $userData->last_name ?? '') }}" required>
                                            @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name">{{ __('Middle Name') }}</label>
                                            <input type="text" name="middle_name" id="middle_name"
                                                   class="form-control @error('middle_name') is-invalid @enderror"
                                                   value="{{ old('middle_name', $userData->middle_name ?? '') }}">
                                            @error('middle_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-4 mb-3">{{ __('Passport Information') }}</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_series">{{ __('Passport Series') }}</label>
                                            <input type="text" name="passport_series" id="passport_series"
                                                   class="form-control @error('passport_series') is-invalid @enderror"
                                                   value="{{ old('passport_series', $userData->passport_series ?? '') }}"
                                                   required>
                                            @error('passport_series')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_number">{{ __('Passport Number') }}</label>
                                            <input type="text" name="passport_number" id="passport_number"
                                                   class="form-control @error('passport_number') is-invalid @enderror"
                                                   value="{{ old('passport_number', $userData->passport_number ?? '') }}"
                                                   required>
                                            @error('passport_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_issued_by">{{ __('Issued By') }}</label>
                                            <input type="text" name="passport_issued_by" id="passport_issued_by"
                                                   class="form-control @error('passport_issued_by') is-invalid @enderror"
                                                   value="{{ old('passport_issued_by', $userData->passport_issued_by ?? '') }}"
                                                   required>
                                            @error('passport_issued_by')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_issued_date">{{ __('Issue Date') }}</label>
                                            <input type="date" name="passport_issued_date" id="passport_issued_date"
                                                   class="form-control @error('passport_issued_date') is-invalid @enderror"
                                                   value="{{ old('passport_issued_date', $userData->passport_issued_date ?? '') }}"
                                                   required>
                                            @error('passport_issued_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sole Proprietor fields -->
                            <div id="commerce-fields" class="owner-type-section"
                                 style="{{ (old('type_owner', $userData->type_owner ?? 0) == 1) ? 'display: block;' : 'display: none;' }}">
                                <h5 class="mt-4 mb-3">{{ __('Sole Proprietor Information') }}</h5>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name_sp">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" id="first_name_sp"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   value="{{ old('first_name', $userData->first_name ?? '') }}"
                                                   required>
                                            @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name_sp">{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" id="last_name_sp"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   value="{{ old('last_name', $userData->last_name ?? '') }}" required>
                                            @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name_sp">{{ __('Middle Name') }}</label>
                                            <input type="text" name="middle_name" id="middle_name_sp"
                                                   class="form-control @error('middle_name') is-invalid @enderror"
                                                   value="{{ old('middle_name', $userData->middle_name ?? '') }}">
                                            @error('middle_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unp_sp">{{ __('UNP (Tax ID)') }}</label>
                                            <input type="text" name="unp" id="unp_sp"
                                                   class="form-control @error('unp') is-invalid @enderror"
                                                   value="{{ old('unp', $userData->unp ?? '') }}" required>
                                            @error('unp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Company fields -->
                            <div id="organization-fields" class="owner-type-section"
                                 style="{{ (old('type_owner', $userData->type_owner ?? 0) == 2) ? 'display: block;' : 'display: none;' }}">
                                <h5 class="mt-4 mb-3">{{ __('Company Information') }}</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_name">{{ __('Company Name') }}</label>
                                            <input type="text" name="company_name" id="company_name"
                                                   class="form-control @error('company_name') is-invalid @enderror"
                                                   value="{{ old('company_name', $userData->company_name ?? '') }}"
                                                   required>
                                            @error('company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unp_company">{{ __('UNP (Tax ID)') }}</label>
                                            <input type="text" name="unp" id="unp_company"
                                                   class="form-control @error('unp') is-invalid @enderror"
                                                   value="{{ old('unp', $userData->unp ?? '') }}" required>
                                            @error('unp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-4 mb-3">{{ __('Responsible Person') }}</h5>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">{{ __('Position') }}</label>
                                            <input type="text" name="position" id="position"
                                                   class="form-control @error('position') is-invalid @enderror"
                                                   value="{{ old('position', $userData->position ?? '') }}" required>
                                            @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name_comp">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" id="first_name_comp"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   value="{{ old('first_name', $userData->first_name ?? '') }}"
                                                   required>
                                            @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name_comp">{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" id="last_name_comp"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   value="{{ old('last_name', $userData->last_name ?? '') }}" required>
                                            @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name_comp">{{ __('Middle Name') }}</label>
                                            <input type="text" name="middle_name" id="middle_name_comp"
                                                   class="form-control @error('middle_name') is-invalid @enderror"
                                                   value="{{ old('middle_name', $userData->middle_name ?? '') }}">
                                            @error('middle_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Document Upload Section -->
                            <h5 class="mt-4 mb-3">Document Upload</h5>
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="documents">Upload Documents (Max 5 files, PDF/PNG/JPG/JPEG/WEBP, 10MB
                                        max each)</label>
                                    <input type="file" name="documents[]" id="documents"
                                           class="form-control @error('documents') is-invalid @enderror @error('documents.*') is-invalid @enderror"
                                           multiple accept=".pdf,.png,.jpg,.jpeg,.webp">
                                    @error('documents')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('documents.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if($userData->documents)
                                        <div class="mt-3">
                                            <h6>Previously Uploaded Documents:</h6>
                                            <ul class="list-group">
                                                @foreach(json_decode($userData->documents, true) as $document)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $document['name'] }}
                                                        <span class="badge bg-primary rounded-pill">{{ round($document['size'] / 1024 / 1024, 2) }} MB</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="form-text text-muted">Uploading new documents will replace
                                                previous uploads.
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                    <span id="button-text">Submit Accreditation</span>
                                    <span id="button-loading" style="display: none;">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                          aria-hidden="true"></span>
                                    Processing...
                                </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle ownership type button selection
            const typeButtons = document.querySelectorAll('.type-owner-buttons button');
            const typeOwnerInput = document.getElementById('type-owner-input');
            const typeSections = document.querySelectorAll('.owner-type-section');
            
            // Function to toggle required attributes based on visibility
            function toggleRequiredAttributes() {
                // Get current selected type
                const currentType = parseInt(typeOwnerInput.value);
                
                // Common fields are always required
                
                // Individual fields
                const individualFields = document.querySelectorAll('#individual-fields input[required]');
                individualFields.forEach(field => {
                    if (currentType === 0) {
                        field.setAttribute('required', '');
                    } else {
                        field.removeAttribute('required');
                    }
                });
                
                // Sole Proprietor fields
                const commerceFields = document.querySelectorAll('#commerce-fields input[required]');
                commerceFields.forEach(field => {
                    if (currentType === 1) {
                        field.setAttribute('required', '');
                    } else {
                        field.removeAttribute('required');
                    }
                });
                
                // Company fields
                const organizationFields = document.querySelectorAll('#organization-fields input[required]');
                organizationFields.forEach(field => {
                    if (currentType === 2) {
                        field.setAttribute('required', '');
                    } else {
                        field.removeAttribute('required');
                    }
                });
            }
            
            // Run once on page load to set initial state
            toggleRequiredAttributes();

            typeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Remove active class from all buttons
                    typeButtons.forEach(btn => {
                        btn.classList.remove('btn-primary');
                        btn.classList.add('btn-outline-primary');
                    });

                    // Add active class to clicked button
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-primary');

                    // Set hidden input value
                    const typeValue = parseInt(this.getAttribute('data-type'));
                    typeOwnerInput.value = typeValue;

                    // Show relevant section and hide others
                    typeSections.forEach(section => section.style.display = 'none');

                    if (typeValue === 0) {
                        document.getElementById('individual-fields').style.display = 'block';
                    } else if (typeValue === 1) {
                        document.getElementById('commerce-fields').style.display = 'block';
                    } else if (typeValue === 2) {
                        document.getElementById('organization-fields').style.display = 'block';
                    }
                    
                    // Update required attributes based on new selection
                    toggleRequiredAttributes();
                });
            });

            // Handle form submission loading state
            document.getElementById('accreditation-form').addEventListener('submit', function () {
                document.getElementById('button-text').style.display = 'none';
                document.getElementById('button-loading').style.display = 'inline-block';
                document.getElementById('submit-btn').disabled = true;
            });
        });
    </script>
@endpush
