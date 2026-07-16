const ERROR_MESSAGE_CONFIRM_PASSWORD_REQUIRED = 'Please confirm your password.';
const ERROR_MESSAGE_PASSWORDS_DO_NOT_MATCH = 'Passwords do not match.';
const ERROR_MESSAGE_PHONE_INVALID = 'Please enter a valid phone number (e.g., 0912 345 6789)';
const ERROR_MESSAGE_PHONE_REQUIRED = 'Phone number is required.';
const PHONE_MAX_LENGTH = 11;

// Hides the  error message under the input field
export function hideFieldError(elementId) {
    let errorMessageElement = document.getElementById(elementId);
    errorMessageElement.style.display = 'none';
    
    errorMessageElement.classList.remove('error');
}

export function showFieldError(elementId, textContent) {
    let errorMessageElement = document.getElementById(elementId);
    errorMessageElement.style.display = 'block';
    errorMessageElement.textContent = textContent;
    
    errorMessageElement.classList.add('error');
}


// Properly formats an inputted phone number
export function formatPhoneNumber(input) {
    // Remove all non-numeric characters
    let value = input.value.replace(/\D/g, '');

    // Format as 09XXXXXXXXX
    if (value.length > PHONE_MAX_LENGTH) {
        value = value.substring(0, PHONE_MAX_LENGTH);
    }
    
    input.value = value;
}

// Validates the inputted phone number
export function validatePhoneNumber(phoneInput) {
    const phone = phoneInput.value.trim();
    
    if (!phone) {
        showFieldError('phone-error-message', ERROR_MESSAGE_PHONE_REQUIRED);
        return false;
    }
    
    // Remove spaces for validation
    const phoneDigits = phone.replace(/\s/g, '');
    
    // Check if it starts with 09 and is exactly 11 digits
    if (!/^09\d{9}$/.test(phoneDigits)) {
        showFieldError('phone-error-message', ERROR_MESSAGE_PHONE_INVALID);
        return false;
    }
    
    // Check length
    if (phoneDigits.length !== 11) {
        showFieldError('phone-error-message', ERROR_MESSAGE_PHONE_INVALID);
        return false;
    }
    
    return true;
}


// Validates the inputted confirm password
export function validateConfirmPassword(passwordInput, confirmPasswordInput) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    
    // Don't check confirm password if password is empty
    if (!password) return;
    
    // If password is entered but confirm password is empty, display an error message
    if (!confirmPassword) {
        showConfirmPasswordError(ERROR_MESSAGE_CONFIRM_PASSWORD_REQUIRED);
        return false;
    }
    
    // If password is not equal to confirm password
    if (password !== confirmPassword) {
        showConfirmPasswordError(ERROR_MESSAGE_PASSWORDS_DO_NOT_MATCH);
        return false;
    }
    
    return true;
}

export function showConfirmPasswordError(message) {
    hideConfirmPasswordError();
    showFieldError('confirm-password-error-message', message);
}

export function hideConfirmPasswordError() {
    hideFieldError('confirm-password-error-message');
}
