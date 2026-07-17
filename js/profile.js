import { validatePhoneNumber, formatPhoneNumber, validateConfirmPassword, hideConfirmPasswordError } from './field_validation.js';
import { validateEmail, validatePasswordRequirements, addPasswordToggle } from './authentication.js';

document.addEventListener('DOMContentLoaded', () => {
    const updateProfileForm = document.getElementById('account-form');
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
    const newPasswordInput = document.querySelector('input[name="new_password"]');
    const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
    if (newPasswordInput && confirmPasswordInput) {
        
        // -- New password events --
        // Validate new password with password requirements
        newPasswordInput.addEventListener('blur', () => {
            validatePasswordRequirements(newPasswordInput);
        });
        // Display password requirements when user is typing something in field
        newPasswordInput.addEventListener('input', () => {
            const requirements = newPasswordInput.closest('.group-input').querySelector('.password-requirements');
            if (requirements) {
                if (newPasswordInput.value) {
                    requirements.style.display = 'block';
                } else {
                    requirements.style.display = 'none';
                }
                
                updatePasswordRequirements(newPasswordInput.value);
            }
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

    const editAccountBtn = document.getElementById('edit-account-btn');
    const accountForm = document.getElementById('account-form');
    const saveAccountBtn = document.getElementById('save-account-btn');
    const formInputs = accountForm.querySelectorAll('.form-control');
    
    editAccountBtn.addEventListener('click', function() {
        const isEditing = this.classList.toggle('editing');
        
        formInputs.forEach(input => {
            input.disabled = !isEditing;
        });
        
        if (isEditing) {
            this.innerHTML = '<i class="fas fa-times"></i>';
            saveAccountBtn.style.display = 'inline-block';
        } else {
            this.innerHTML = '<i class="fas fa-edit"></i>';
            saveAccountBtn.style.display = 'none';
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