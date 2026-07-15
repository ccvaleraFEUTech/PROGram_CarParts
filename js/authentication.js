/*
    [Documentation]
    This file contains functions for email validation and password toggle.
*/

const ERROR_MESSAGE_EMAIL_REQUIRED = 'Email is required.';
const ERROR_MESSAGE_EMAIL_INVALID = 'Please enter a valid email address.';

// Email validation using standard regex pattern for user registration
export function validateEmail(emailInput) {
    const email = emailInput.value.trim();

    // Regex pattern for email validation
    const emailRegexPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!email) {
        displayEmailError(emailInput, ERROR_MESSAGE_EMAIL_REQUIRED);
        return false;
    }
    
    if (!emailRegexPattern.test(email)) {
        displayEmailError(emailInput, ERROR_MESSAGE_EMAIL_INVALID);
        return false;
    }
    
    return true;
}

// Shows an email error message under the input field
export function displayEmailError(emailInput, message) {
    // Clear any existing error
    clearEmailError(emailInput);
    
    // Show the error message
    let emailErrorMessage = document.getElementById('email-error-message');
    emailErrorMessage.style.display = 'block';
    emailErrorMessage.textContent = message;
}

// Hides the email error message under the input field
export function clearEmailError(emailInput) {
    let emailErrorMessage = document.getElementById('email-error-message');
    emailErrorMessage.style.display = 'none';
    
    emailInput.classList.remove('error');
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