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

