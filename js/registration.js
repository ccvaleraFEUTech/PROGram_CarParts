import { formatPhoneNumber, validatePhoneNumber, validateConfirmPassword, hideFieldError } from './field_validation.js';
import { validateEmail, addPasswordToggle, validatePasswordRequirements } from './authentication.js';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form[action="login/register_handler.php"]');
    if (!form) return;

    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');
    const phoneInput = form.querySelector('input[name="contact-number"]');

    // Email Format Validation
    if (emailInput) {
        emailInput.addEventListener('blur', () => {
            validateEmail(emailInput);
        });

        emailInput.addEventListener('input', () => {
            hideFieldError('email-error-message');
        });
    }

    

    // Confirm Password Validation
    if (confirmPasswordInput && passwordInput) {
        confirmPasswordInput.addEventListener('blur', () => {
            validateConfirmPassword(passwordInput, confirmPasswordInput);
        });

        confirmPasswordInput.addEventListener('input', () => {
            hideFieldError('confirm-password-error-message');
        });

        passwordInput.addEventListener('blur', () => {
            validatePasswordRequirements(passwordInput);
        });

        passwordInput.addEventListener('input', () => {
            if (confirmPasswordInput.value) {
                validateConfirmPassword(passwordInput, confirmPasswordInput);
            }

            const requirements = document.querySelector('.password-requirements');
            if (passwordInput.value) {
                requirements.style.display = 'block';
            } else {
                requirements.style.display = 'none';
            }
            updatePasswordRequirements(passwordInput.value);
        });
    }

    // Show/Hide Password Toggle
    if (passwordInput) {
        addPasswordToggle(passwordInput);
    }

    if (confirmPasswordInput) {
        addPasswordToggle(confirmPasswordInput);
    }

    // Form Submission Validation
    form.addEventListener('submit', (e) => {
        if (!validateRegistrationForm(form)) {
            e.preventDefault();
        }
    });

    // Phone number formatting and validation
    if (phoneInput) {

        phoneInput.addEventListener('input', () => {
            hideFieldError('phone-error-message');
            formatPhoneNumber(phoneInput);
        });
        
        phoneInput.addEventListener('blur', () => {
            validatePhoneNumber(phoneInput);
        });
    }
});

function updatePasswordRequirements(password) {
    const requirements = validatePasswordRequirements(password);
    const requirementItems = document.querySelectorAll('.password-requirements li');

    Object.keys(requirements).forEach((key, index) => {
        if (requirementItems[index]) {
            const icon = requirementItems[index].querySelector('i');
            if (requirements[key]) {
                requirementItems[index].classList.add('valid');
                if (icon) icon.className = 'fa-solid fa-check-circle';
            } else {
                requirementItems[index].classList.remove('valid');
                if (icon) icon.className = 'fa-solid fa-circle';
            }
        }
    });
}

function validateRegistrationForm(form) {
    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');
    const phoneInput = form.querySelector('input[name="contact-number"]');
    
    let isValid = true;
    
    if (emailInput && !validateEmail(emailInput)) {
        isValid = false;
    }
    
    if (passwordInput && confirmPasswordInput) {
        const passwordRequirements = validatePasswordRequirements(passwordInput.value);
        const meetsRequirements = Object.values(passwordRequirements).every(req => req === true);
        
        if (!validateConfirmPassword(passwordInput, confirmPasswordInput) || !meetsRequirements) {
            isValid = false;
        }
    }

    if (phoneInput && !validatePhoneNumber(phoneInput)) {
        isValid = false;
    }
    
    return isValid;
}