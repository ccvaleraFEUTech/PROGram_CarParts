import { validateEmail, addPasswordToggle } from './authentication.js';
import { hideFieldError, showFieldError } from './field_validation.js';

const ERROR_MESSAGE_PASSWORD_REQUIRED = 'Password is required.';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form[action="login/login_handler.php"]');
    if (!form) return;

    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');

    // Email Format Validation
    if (emailInput) {
        emailInput.addEventListener('blur', () => {
            validateEmail(emailInput);
        });

        emailInput.addEventListener('input', () => {
            hideFieldError("email-error-message");
        });
    }

    // Password validation
    if (passwordInput) {
        passwordInput.addEventListener('blur', () => {
            validatePassword(passwordInput);
        });

        passwordInput.addEventListener('input', () => {
            clearPasswordError();
        });
    }

    // Show/Hide Password Toggle
    if (passwordInput) {
        addPasswordToggle(passwordInput);
    }

    // Form Submission Validation
    form.addEventListener('submit', (e) => {
        if (!validateLoginForm(form)) {
            e.preventDefault();
        }
    });
});

function validatePassword(passwordInput) {
    const password = passwordInput.value.trim();
    
    if (!password) {
        showPasswordError(ERROR_MESSAGE_PASSWORD_REQUIRED);
        return false;
    }   
    
    return true;
}

// Shows a password error message under the input field
function showPasswordError(message) {
    clearPasswordError();
    
    showFieldError("password-error-message", message);
}

// Clears any existing password error message
function clearPasswordError() {
    hideFieldError("password-error-message");
}

// Validates the entire login form
function validateLoginForm(form) {
    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');
    
    let isValid = true;
    
    if (emailInput && !validateEmail(emailInput)) {
        isValid = false;
    }
    
    if (passwordInput && !validatePassword(passwordInput)) {
        isValid = false;
    }
    
    return isValid;
}