<div x-data="registerForm" class="w-100">
    <form id="register-form" action="{{ route('user.register.handle') }}" method="POST">
        @csrf
        <div class="row">
            <!-- User type selection buttons -->
            <div class="w-100 d-flex justify-content-center mb-4">
                <template x-for="typeOwner in typeOwners" :key="typeOwner.value">
                    <button type="button" class="btn m-1 p-2"
                        :class="activeTab === typeOwner.value ? 'btn-primary' : 'btn-outline-primary'"
                        @click="showInputs(typeOwner.value)"
                        x-text="typeOwner.label">
                    </button>
                </template>
            </div>
            <div class="col-md-12" x-show="errors.type_owner">
                <div class="error-message text-danger" x-text="getErrorMessage('type_owner')"></div>
            </div>

            <!-- Common fields for all user types -->
            <div class="col-md-6">
                <div class="form-inner">
                    <label>{{ __('Full Name') }} *</label>
                    <input type="text" name="fio" id="fio" x-model="regForm.fio" placeholder="{{ __('Enter Your Full Name') }}" class="form-control">
                    <div class="error-message text-danger" x-show="errors.fio" x-text="getErrorMessage('fio')"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-inner ">
                    <label for="region">{{ __('Region') }} *</label>
                    <select class="form-control" name="region" id="region" x-model="regForm.region" x-init="setTimeout(() => { $('#region').removeClass('nice-select').prev('.nice-select').remove(); }, 50)">
                        @foreach($regions as $key => $reg )
                            <option {{ $key == 0 ? "data-display='{$reg['name']}'" : '' }} style="text-align : center;" value="{{ $reg['id'] }}" {{ $reg['id'] == old('region') ? 'selected' : '' }}>{{ $reg['name']}}</option>
                        @endforeach
                    </select>
                    <div class="error-message text-danger" x-show="errors.region" x-text="getErrorMessage('region')"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-inner">
                    <label>{{ __('Address') }} *</label>
                    <input  class="form-control" type="text" name="address" id="address"
                            x-model="regForm.address" placeholder="{{ __('Enter Your Address') }}">
                    <div class="error-message text-danger" x-show="errors.address" x-text="getErrorMessage('address')"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-inner">
                    <label>{{ __('Phone') }} *</label>
                    <input type="text" name="phone" id="phone" x-model="regForm.phone" placeholder="{{ __('Enter Your Phone') }}" class="form-control">
                    <div class="error-message text-danger" x-show="errors.phone" x-text="getErrorMessage('phone')"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-inner">
                    <label>{{ __('Email') }} *</label>
                    <input type="email" name="email" id="email" x-model="regForm.email" placeholder="{{ __('Enter Your Email') }}" class="form-control">
                    <div class="error-message text-danger" x-show="errors.email" x-text="getErrorMessage('email')"></div>
                </div>
            </div>

            <!-- Fields for Individual -->
            <template x-if="activeTab === 0">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h5 class="mt-3">{{ __('Passport Information') }}</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inner">
                            <label>{{ __('Passport Series') }} *</label>
                            <input type="text" name="passport_series" id="passport_series" x-model="regForm.passport_series" placeholder="{{ __('Enter Passport Series') }}" class="form-control">
                            <div class="error-message text-danger" x-show="errors.passport_series" x-text="getErrorMessage('passport_series')"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inner">
                            <label>{{ __('Passport Number') }} *</label>
                            <input type="text" name="passport_number" id="passport_number" x-model="regForm.passport_number" placeholder="{{ __('Enter Passport Number') }}" class="form-control">
                            <div class="error-message text-danger" x-show="errors.passport_number" x-text="getErrorMessage('passport_number')"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inner">
                            <label>{{ __('Passport Issued By') }} *</label>
                            <input type="text" name="passport_issued_by" id="passport_issued_by" x-model="regForm.passport_issued_by" placeholder="{{ __('Enter Passport Issued By') }}" class="form-control">
                            <div class="error-message text-danger" x-show="errors.passport_issued_by" x-text="getErrorMessage('passport_issued_by')"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inner">
                            <label>{{ __('Passport Issued Date') }} *</label>
                            <input type="date" name="passport_issued_date" id="passport_issued_date" x-model="regForm.passport_issued_date" class="form-control">
                            <div class="error-message text-danger" x-show="errors.passport_issued_date" x-text="getErrorMessage('passport_issued_date')"></div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Fields for Commerce -->
            <template x-if="activeTab === 1">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h5 class="mt-3">{{ __('Business Information') }}</h5>
                    </div>
                    <div class="col-md-12">
                        <div class="form-inner">
                            <label>{{ __('UNP') }} *</label>
                            <input type="text" name="unp" id="unp" x-model="regForm.unp" placeholder="{{ __('Enter Your UNP') }}" class="form-control">
                            <div class="error-message text-danger" x-show="errors.unp" x-text="getErrorMessage('unp')"></div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Fields for Organization -->
            <template x-if="activeTab === 3">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h5 class="mt-3">{{ __('Company Information') }}</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inner">
                            <label>{{ __('Company Name') }} *</label>
                            <input type="text" name="company_name" id="company_name" x-model="regForm.company_name" placeholder="{{ __('Enter Company Name') }}" class="form-control">
                            <div class="error-message text-danger" x-show="errors.company_name" x-text="getErrorMessage('company_name')"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inner">
                            <label>{{ __('UNP') }} *</label>
                            <input type="text" name="unp" id="unp_org" x-model="regForm.unp" placeholder="{{ __('Enter Company UNP') }}" class="form-control">
                            <div class="error-message text-danger" x-show="errors.unp" x-text="getErrorMessage('unp')"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-inner">
                            <label>{{ __('Additional Information') }}</label>
                            <textarea name="info" id="info" x-model="regForm.info" placeholder="{{ __('Enter Additional Information') }}" class="form-control"></textarea>
                            <div class="error-message text-danger" x-show="errors.info" x-text="getErrorMessage('info')"></div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Password fields for all types -->
            <div class="col-md-6 mt-3">
                <div class="form-inner">
                    <label>{{ __('Create A Password') }} *</label>
                    <input type="password" name="password" id="password" x-model="regForm.password" autocomplete="new-password" placeholder="{{ __('Create A Password') }}" class="form-control">
                    <div class="error-message text-danger" x-show="errors.password" x-text="getErrorMessage('password')"></div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="form-inner">
                    <label>{{ __('Confirm Password') }} *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" x-model="regForm.password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" class="form-control">
                    <div class="error-message text-danger" x-show="errors.password_confirmation" x-text="getErrorMessage('password_confirmation')"></div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                    <div class="form-group">
                        <input type="checkbox" id="terms" name="terms" x-model="regForm.terms">
                        <label for="terms">{{ __('I agree to the Terms & Policy') }}</label>
                        <span class="text-danger d-block fs-6" x-show="errors.terms" x-text="getErrorMessage('terms')"></span>
                    </div>
                </div>
            </div>

            <!-- Global errors and success messages -->
            <div class="col-md-12 mt-2" x-show="formError">
                <div class="alert alert-danger" x-text="formError"></div>
            </div>
            <div class="col-md-12 mt-2" x-show="formSuccess">
                <div class="alert alert-success" x-text="formSuccess"></div>
            </div>

            <div class="col-md-12 mt-3">
                <button type="button" @click="sendForm" class="account-btn w-100" :disabled="formSubmitting">
                    <span x-show="!formSubmitting">{{ __('Create Account') }}</span>
                    <span x-show="formSubmitting">{{ __('Processing...') }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
// Wait for Alpine.js to load
document.addEventListener('alpine:init', () => {
    Alpine.data('registerForm', () => ({
        activeTab: 0,
        errors: {},
        formError: null,
        formSuccess: null,
        formSubmitting: false,
        regForm: {
            'type_owner': 0,
            'fio': '',
            'region': 1,
            'address': '',
            'phone': '',
            'email': '',
            'passport_series': '',
            'passport_number': '',
            'passport_issued_by': '',
            'passport_issued_date': '',
            'unp': '',
            'info': '',
            'company_name': '',
            'password': '',
            'password_confirmation': '',
            'terms': false
        },
        typeOwners: @json($typeOwners),
        regions: @json($regions),

        // Get error message with safe check
        getErrorMessage(fieldName) {
            return this.errors[fieldName] && this.errors[fieldName].length > 0
                ? this.errors[fieldName][0]
                : '';
        },

        // Component initialization and event handlers setup
        init() {
            // Set initial user type explicitly
            this.activeTab = 0;
            this.regForm.type_owner = 0;

            // Debug - make sure regions are loaded and accessible
            console.log('Regions data:', this.regions);

            // Only set default region if regions exist and have data
            if (this.regions && this.regions.length > 0) {
                this.regForm.region = this.regions[0].id;
            }

            // Add watchers to clear errors on input
            const formFields = [
                'fio', 'region', 'address', 'phone', 'email',
                'passport_series', 'passport_number', 'passport_issued_by', 'passport_issued_date',
                'unp', 'company_name', 'info', 'password', 'password_confirmation', 'terms'
            ];

            // Setup watchers for all form fields
            formFields.forEach(field => {
                this.$watch(`regForm.${field}`, () => {
                    this.clearError(field);
                });
            });
        },

        // Clear specific error
        clearError(fieldName) {
            if (this.errors[fieldName]) {
                delete this.errors[fieldName];
            }
        },

        // Reset all errors
        resetErrors() {
            this.errors = {};
            this.formError = null;
        },

        // Show inputs for selected user type
        showInputs(typeOwner) {
            this.resetErrors();
            this.activeTab = typeOwner;
            this.regForm.type_owner = typeOwner;
            // Очищаем поля, которые больше не нужны
            if(typeOwner === 0) {
                // Individual - очистить поля для Commerce и Organization
                this.regForm.unp = '';
                this.regForm.info = '';
                this.regForm.company_name = '';
            } else if(typeOwner === 1) {
                // Commerce - очистить поля для Individual и Organization
                this.regForm.passport_series = '';
                this.regForm.passport_number = '';
                this.regForm.passport_issued_by = '';
                this.regForm.passport_issued_date = '';
                this.regForm.company_name = '';
            } else if(typeOwner === 3) {
                // Organization - очистить поля для Individual и Commerce
                this.regForm.passport_series = '';
                this.regForm.passport_number = '';
                this.regForm.passport_issued_by = '';
                this.regForm.passport_issued_date = '';
            }
        },

        showNotify(message, type = 'error') {
            if (typeof window.notify !== 'undefined') {
                try {
                    window.notify[type](message);
                } catch (e) {
                    // Fallback to alert if Notyf fails
                    alert(message);
                }
            } else {
                // Fallback if Notyf is not loaded
                alert(message);
            }
        },

        sendForm() {
            this.resetErrors();
            this.formSubmitting = true;

            // Ensure type_owner is a number
            if (typeof this.regForm.type_owner === 'string') {
                this.regForm.type_owner = parseInt(this.regForm.type_owner, 10);
            }

            // Use global axios from Vite
            window.axios.post('/register', this.regForm)
            .then(response => {
                this.formSuccess = response.data.message || "{{ __('Registration successful! Redirecting...') }}";
                this.showNotify(this.formSuccess, 'success');

                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            })
            .catch(error => {
                this.formSubmitting = false;

                if (error.response && error.response.data) {
                    // Handle validation errors
                    if (error.response.data.errors) {
                        this.errors = error.response.data.errors;

                        // Show first error in notification
                        let firstErrorField = Object.keys(this.errors)[0];
                        if (firstErrorField && this.errors[firstErrorField].length > 0) {
                            this.showNotify(this.errors[firstErrorField][0], 'error');
                        }
                    } else if (error.response.data.message) {
                        // General server error
                        this.formError = error.response.data.message;
                        this.showNotify(this.formError, 'error');
                    }
                } else {
                    // Network or other unexpected error
                    this.formError = "{{ __('An error occurred. Please try again later.') }}";
                    this.showNotify(this.formError, 'error');
                }
            });
        }
    }))
})
</script>
