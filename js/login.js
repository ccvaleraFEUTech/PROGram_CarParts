import { validateEmail, clearEmailError, addPasswordToggle, validatePassword } from './authentication.js';

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
            clearEmailError(emailInput);
        });
    }

    // Password validation
    if (passwordInput) {
        passwordInput.addEventListener('blur', () => {
            validatePassword(passwordInput);
        });

        passwordInput.addEventListener('input', () => {
            clearPasswordError(passwordInput);
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

// Shows a password error message under the input field
function showPasswordError(passwordInput, message) {
    clearPasswordError(passwordInput);
    
    let passwordErrorMessage = document.getElementById('password-error-message');
    passwordErrorMessage.style.display = 'block';
    passwordErrorMessage.textContent = message;
}

// Clears any existing password error message
function clearPasswordError(passwordInput) {
    let passwordErrorMessage = document.getElementById('password-error-message');
    passwordErrorMessage.style.display = 'none';
    passwordInput.classList.remove('error');
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