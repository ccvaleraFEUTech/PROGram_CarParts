// Registration Form Enhancements
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
            clearEmailError(emailInput);
        });
    }


    // Confirm Password Validation
    if (confirmPasswordInput && passwordInput) {
        confirmPasswordInput.addEventListener('blur', () => {
            validateConfirmPassword(passwordInput, confirmPasswordInput);
        });

        confirmPasswordInput.addEventListener('input', () => {
            clearConfirmPasswordError(confirmPasswordInput);
        });

        passwordInput.addEventListener('input', () => {
            if (confirmPasswordInput.value) {
                validateConfirmPassword(passwordInput, confirmPasswordInput);
            }
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
            clearPhoneNumberError(phoneInput);
            formatPhoneNumber(phoneInput);
        });
        
        phoneInput.addEventListener('blur', () => {
            validatePhoneNumber(phoneInput);
        });
    }
});

function formatPhoneNumber(input) {
    // Remove all non-numeric characters
    let value = input.value.replace(/\D/g, '');
    
    const phoneMaxLength = 11;

    // Format as 09XX XXX XXXX
    if (value.length > phoneMaxLength) {
        value = value.substring(0, phoneMaxLength);
    }
    
    if (value.length > 6) {
        value = value.replace(/(\d{4})(\d{0,3})(\d{0,4})/, '$1 $2 $3');
    } else if (value.length >= 4) {
        value = value.replace(/(\d{4})(\d{0,3})/, '$1 $2');
    }
    
    input.value = value;
}

function validatePhoneNumber(phoneInput) {
    const phone = phoneInput.value.trim();
    
    if (!phone) {
        showPhoneNumberError(phoneInput, 'Phone number is required');
        return false;
    }
    
    // Remove spaces for validation
    const phoneDigits = phone.replace(/\s/g, '');
    
    // Check if it starts with 09 and is exactly 11 digits
    if (!/^09\d{9}$/.test(phoneDigits)) {
        showPhoneNumberError(phoneInput, 'Please enter a valid phone number (e.g., 0912 345 6789)');
        return false;
    }
    
    // Check length
    if (phoneDigits.length !== 11) {
        showPhoneNumberError(phoneInput, 'Please enter a valid phone number (e.g., 0912 345 6789)');
        return false;
    }
    
    return true;
}

function showPhoneNumberError(phoneInput, message) {
    clearPhoneNumberError(phoneInput);
    
    let phoneErrorMessage = document.getElementById('phone-error-message');
    phoneErrorMessage.style.display = 'block';
    phoneErrorMessage.textContent = message;
}

function clearPhoneNumberError(phoneInput) {
    let phoneErrorMessage = document.getElementById('phone-error-message');
    phoneErrorMessage.style.display = 'none';
    phoneInput.classList.remove('error');
}

function validateEmail(emailInput) {
    const email = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!email) {
        showEmailError(emailInput, 'Email is required');
        return false;
    }
    
    if (!emailRegex.test(email)) {
        showEmailError(emailInput, 'Please enter a valid email address');
        return false;
    }
    
    return true;
}

function showEmailError(emailInput, message) {
    clearEmailError(emailInput);
    
    let emailErrorMessage = document.getElementById('email-error-message');
    emailErrorMessage.style.display = 'block';
    emailErrorMessage.textContent = message;
}

function clearEmailError(emailInput) {
    let emailErrorMessage = document.getElementById('email-error-message');
    emailErrorMessage.style.display = 'none';
    emailInput.classList.remove('error');
}


function validateConfirmPassword(passwordInput, confirmPasswordInput) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    
    if (!password) return;
    
    if (!confirmPassword) {
        showConfirmPasswordError(confirmPasswordInput, 'Please confirm your password');
        return false;
    }
    
    if (password !== confirmPassword) {
        showConfirmPasswordError(confirmPasswordInput, 'Passwords do not match');
        return false;
    }
    
    return true;
}

function showConfirmPasswordError(confirmPasswordInput, message) {
    clearConfirmPasswordError(confirmPasswordInput);

    let confirmPasswordErrorMessage = document.getElementById('confirm-password-error-message');
    confirmPasswordErrorMessage.style.display = 'block';
    confirmPasswordErrorMessage.textContent = message;
}

function clearConfirmPasswordError(confirmPasswordInput) {
    let confirmPasswordErrorMessage = document.getElementById('confirm-password-error-message');
    confirmPasswordErrorMessage.style.display = 'none';
    confirmPasswordInput.classList.remove('error');
}

function addPasswordToggle(passwordInput) {
    const wrapper = passwordInput.closest('.password-wrapper');
    if (!wrapper) return;
    
    const toggleIcon = wrapper.querySelector('.password-toggle');
    if (!toggleIcon) return;
    
    toggleIcon.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle between fa-eye and fa-eye-slash
        if (type === 'password') {
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });
}

function validateRegistrationForm(form) {
    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');
    
    let isValid = true;
    
    if (emailInput && !validateEmail(emailInput)) {
        isValid = false;
    }
    
    if (passwordInput && confirmPasswordInput && !validateConfirmPassword(passwordInput, confirmPasswordInput)) {
        isValid = false;
    }
    
    return isValid;
}