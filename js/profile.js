import { validatePhoneNumber, formatPhoneNumber, validateConfirmPassword, hideConfirmPasswordError } from './field_validation.js';
import { validateEmail } from './authentication.js';

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
        newPasswordInput.addEventListener('blur', () => {
            // TODO: Add password validation
        });
        confirmPasswordInput.addEventListener('blur', () => {
            validateConfirmPassword(newPasswordInput, confirmPasswordInput);
        });
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
        // TODO: Add form validation
    });
});

function validateUpdateForm(form) {
    // email, phone, and region name
    
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
        // TODO: Add region validation
    }

    return isValid;
}
