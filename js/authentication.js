import { hideFieldError, showFieldError } from './field_validation.js';

const ERROR_MESSAGE_EMAIL_REQUIRED = 'Email is required.';
const ERROR_MESSAGE_EMAIL_INVALID = 'Please enter a valid email address.';
const EMAIL_REGEX_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Email validation using standard regex pattern for user registration
export function validateEmail(emailInput) {
    const email = emailInput.value.trim();

    if (!email) {
        displayEmailError(ERROR_MESSAGE_EMAIL_REQUIRED);
        return false;
    }
    
    if (!EMAIL_REGEX_PATTERN.test(email)) {
        displayEmailError(ERROR_MESSAGE_EMAIL_INVALID);
        return false;
    }
    
    return true;
}

// Shows an email error message under the input field
export function displayEmailError(message) {
    // Clear any existing error
    hideFieldError('email-error-message');
    
    // Show the error message
    showFieldError('email-error-message', message);
}

// Enables password toggle to a password-related field, which toggles between showing and hiding the password
export function addPasswordToggle(passwordInput) {
    const wrapper = passwordInput.closest('.password-wrapper');
    if (!wrapper) return;
    
    const toggleIcon = wrapper.querySelector('.password-toggle');
    if (!toggleIcon) return;
    
    toggleIcon.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        if (type === 'password') {
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });
}

// Function to validate password requirements
export function validatePasswordRequirements(password) {
    const requirements = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password)
    };

    return requirements;
}