<div class="w-100 form-wrapper" id="register-form-container">
    <h3 class="mb-4 text-center">{{ __('Create an Account') }}</h3>
    <p class="text-center mb-4">{{ __('Enter your details to create an account. You will need to verify your email before proceeding.') }}</p>
    <form id="register-form" action="{{ route('user.register.handle') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-inner single-input-inner">
                    <label>{{ __('Full Name') }} *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('Enter Your Full Name') }}" class="form-control" autocomplete="name" required>
                    <div class="error-message text-danger error-container" id="error-name" style="display: none;"></div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-inner single-input-inner">
                    <label>{{ __('Email') }} *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('Enter Your Email') }}" class="form-control" autocomplete="email" required>
                    <div class="error-message text-danger error-container" id="error-email" style="display: none;"></div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-inner single-input-inner">
                    <label>{{ __('Password') }} *</label>
                    <input type="password" name="password" id="password" placeholder="{{ __('Enter Your Password') }}" class="form-control" autocomplete="new-password" required>
                    <div class="error-message text-danger error-container" id="error-password" style="display: none;"></div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-inner single-input-inner">
                    <label>{{ __('Confirm Password') }} *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm Your Password') }}" class="form-control" autocomplete="new-password" required>
                    <div class="error-message text-danger error-container" id="error-password_confirmation" style="display: none;"></div>
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-inner single-input-inner">
            <div class="checkbox-wrap">
                <label>
                    <input type="checkbox" name="terms" id="terms" value="1" {{ old('terms') ? 'checked' : '' }} required>
                    <span class="checkmark"></span>
                    <span class="ms-2">{{ __('I agree to the') }} <a href="#">{{ __('Terms & Conditions') }}</a></span>
                </label>
                <div class="error-message text-danger error-container" id="error-terms" style="display: none;"></div>
                @error('terms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="account-btn w-100" id="register-button">
            <span id="button-text">{{ __('Create Account') }}</span>
            <span id="button-loading" style="display: none;">{{ __('Processing...') }}</span>
        </button>
    </form>
</div>

<script>
// Define an empty registerForm object to prevent errors from other scripts expecting Alpine.js
window.registerForm = {};

document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission
                    document.getElementById('company_name').value = '';
                }
            } else if (typeValue === 3) {
                document.getElementById('organization-fields').style.display = 'block';
                // Clear individual fields
                document.getElementById('passport_series').value = '';
                document.getElementById('passport_number').value = '';
                document.getElementById('passport_issued_by').value = '';
                document.getElementById('passport_issued_date').value = '';
            }
            
            // Clear any errors
            clearAllErrors();
        });
    });
    
    // Form submission
    const form = document.getElementById('register-form');
    const submitBtn = document.getElementById('submit-btn');
    const processingBtn = document.getElementById('processing-btn');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        clearAllErrors();
        
        // Show processing state
        submitBtn.style.display = 'none';
        processingBtn.style.display = 'block';
        
        // Submit form normally (Laravel will handle validation)
        this.submit();
    });
    
    // Helper function to show notification
    function showNotify(message, type = 'error') {
        if (typeof window.notify !== 'undefined') {
            try {
                window.notify[type](message);
            } catch (e) {
                alert(message);
            }
        } else {
            alert(message);
        }
    }
    
    // Helper function to clear all error displays
    function clearAllErrors() {
        const errorContainers = document.querySelectorAll('.error-container');
        errorContainers.forEach(container => {
            container.style.display = 'none';
            container.textContent = '';
        });
        
        document.getElementById('form-error-container').style.display = 'none';
        document.getElementById('form-error-message').textContent = '';
    }
    
    // Initialize form with any error messages from server-side validation
    const errorElements = document.querySelectorAll('.text-danger');
    if (errorElements.length > 0) {
        // Get the first error message for notification
        let firstErrorMessage = null;
        errorElements.forEach(el => {
            if (el.textContent.trim() !== '' && !firstErrorMessage) {
                firstErrorMessage = el.textContent.trim();
            }
        });
        
        if (firstErrorMessage) {
            showNotify(firstErrorMessage);
        }
    }
    
    // Success message handling
    if (document.getElementById('form-success-container').style.display !== 'none') {
        const successMsg = document.getElementById('form-success-message').textContent;
        if (successMsg) {
            showNotify(successMsg, 'success');
        }
    }
});
</script>
