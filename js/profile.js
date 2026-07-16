/*
    Things to validate in the profile.js:
    1. email address?
    2. contact number
    3. current password, new password, confirm new password
*/
function validateUpdateForm(form) {
    // email, phone, and region name
    
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
        // TODO: Add region validation
    }

    return isValid;
}
