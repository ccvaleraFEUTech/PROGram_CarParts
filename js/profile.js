import { validatePhoneNumber, formatPhoneNumber, validateConfirmPassword, hideConfirmPasswordError } from './field_validation.js';
import { validateEmail, validatePasswordRequirements, addPasswordToggle } from './authentication.js';

document.addEventListener('DOMContentLoaded', () => {
    const updateProfileForm = document.getElementById('update-profile-form');
    const changePasswordForm = document.getElementById('change-password-form');
    
    // Phone number validation
    const phoneInput = document.querySelector('input[name="contact-number"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', () => {
            formatPhoneNumber(phoneInput);
        });
        
        phoneInput.addEventListener('blur', () => {
            validatePhoneNumber(phoneInput);
        });
    }

    // Show/Hide Password Toggle
    const passwordInputs = document.querySelectorAll('.password-wrapper input[type="password"]');
    passwordInputs.forEach(input => {
        addPasswordToggle(input);
    });
    
    // Email validation
    const emailInput = document.querySelector('input[name="email"]');
    if (emailInput) {
        emailInput.addEventListener('blur', () => {
            validateEmail(emailInput);
        });
    }

    // New Password and Confirm Password validation
    const newPasswordInput = document.querySelector('input[name="new-password"]');
    const confirmPasswordInput = document.querySelector('input[name="confirm-new-password"]');
    if (newPasswordInput && confirmPasswordInput) {
        
        // -- New password events --
        // Validate new password with password requirements
        newPasswordInput.addEventListener('blur', () => {
            validatePasswordRequirements(newPasswordInput);
        });
        // Display password requirements when user is typing something in field
        newPasswordInput.addEventListener('input', () => {
            const requirements = document.querySelector('.password-requirements');
            if (newPasswordInput.value) {
                requirements.style.display = 'block';
            } else {
                requirements.style.display = 'none';
            }
            
            updatePasswordRequirements(newPasswordInput.value);
        });

        // -- Confirm password events --
        // Validate confirm password on blur
        confirmPasswordInput.addEventListener('blur', () => {
            validateConfirmPassword(newPasswordInput, confirmPasswordInput);
        });
        // Hide confirm password error when user is typing
        confirmPasswordInput.addEventListener('input', () => {
            hideConfirmPasswordError();
        });
    }

    updateProfileForm.addEventListener('submit', (e) => {
        if (!validateUpdateForm(updateProfileForm)) {
            e.preventDefault();
        }
    });

    changePasswordForm.addEventListener('submit', (e) => {
        if (!validateChangePasswordForm(changePasswordForm)) {
            e.preventDefault();
        }
    });

    
});

function validateUpdateForm(form) {
    const emailInput = form.querySelector('input[name="email"]');
    const phoneInput = form.querySelector('input[name="contact-number"]');
    const regionInput = form.querySelector('input[name="region-name"]');

    let isValid = true;
    
    if (emailInput && !validateEmail(emailInput)) {
        isValid = false;
    }

    if (phoneInput && !validatePhoneNumber(phoneInput)) {
        isValid = false;
    }

    if (regionInput) {
        
    }

    return isValid;
}

function validateChangePasswordForm(form) {
    let isValid = true;

    const currentPasswordInput = form.querySelector('input[name="current-password"]');
    const newPasswordInput = form.querySelector('input[name="new-password"]');
    const confirmPasswordInput = form.querySelector('input[name="confirm-new-password"]');

    if (currentPasswordInput && !validatePassword(currentPasswordInput)) {
        isValid = false;
    }

    if (newPasswordInput && !validatePassword(newPasswordInput)) {
        isValid = false;
    }

    if (confirmPasswordInput && !validateConfirmPassword(newPasswordInput, confirmPasswordInput)) {
        isValid = false;
    }

    return isValid;
}

function updatePasswordRequirements(password) {
    const requirements = validatePasswordRequirements(password);

    Object.keys(requirements).forEach(key => {
        const element = document.getElementById(`req-${key}`);
        if (requirements[key]) {
            element.classList.add('valid');
        } else {
            element.classList.remove('valid');
        }
    });
}
