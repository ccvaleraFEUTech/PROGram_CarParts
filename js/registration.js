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

