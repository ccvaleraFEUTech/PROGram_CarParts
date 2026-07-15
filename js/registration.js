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
    
    // TODO: Make the email error message visible and set text
}

function clearEmailError(emailInput) {
    // TODO: Make the email error message disappear
}


function validateConfirmPassword(passwordInput, confirmPasswordInput) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    
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

}

function clearConfirmPasswordError(confirmPasswordInput) {
    const existingError = confirmPasswordInput.parentNode.nextElementSibling;
    if (existingError && existingError.className === 'confirm-password-error') {
        existingError.remove();
    }
    confirmPasswordInput.style.borderColor = '';
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
