// Registration Form Enhancements
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form[action="login/register_handler.php"]');
    if (!form) return;

    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');

    // Email Format Validation
    if (emailInput) {
        emailInput.addEventListener('blur', () => {
            validateEmail(emailInput);
        });

        emailInput.addEventListener('input', () => {
            clearEmailError(emailInput);
        });
    }

    // Password Re
<<<<<<< HEAD
    // Password Requirements Checklist
    if (passwordInput) {
        updatePasswordRequirements(passwordInput);

        passwordInput.addEventListener('input', () => {
            updatePasswordRequirements(passwordInput);
        });
    }
=======
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a

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
});

function validateEmail(emailInput) {
    const email = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
<<<<<<< HEAD

=======
    
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
    if (!email) {
        showEmailError(emailInput, 'Email is required');
        return false;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
    if (!emailRegex.test(email)) {
        showEmailError(emailInput, 'Please enter a valid email address');
        return false;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
    return true;
}

function showEmailError(emailInput, message) {
    clearEmailError(emailInput);
<<<<<<< HEAD

    let emailErrorMessage = document.getElementById('email-error-message');
    if (!emailErrorMessage) return;

=======
    
    let emailErrorMessage = document.getElementById('email-error-message');
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
    emailErrorMessage.style.display = 'block';
    emailErrorMessage.textContent = message;
}

function clearEmailError(emailInput) {
<<<<<<< HEAD
    const emailErrorMessage = document.getElementById('email-error-message');
    if (emailErrorMessage) {
        emailErrorMessage.style.display = 'none';
        emailErrorMessage.textContent = '';
    }

    if (emailInput) {
        emailInput.style.borderColor = '';
    }
}

function checkPasswordRequirements(password) {
    return {
        minlength: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[^A-Za-z0-9]/.test(password)
    };
}

function updatePasswordRequirements(passwordInput) {
    const requirementsList = document.getElementById('password-requirements');
    if (!requirementsList) return;

    const results = checkPasswordRequirements(passwordInput.value);

    Object.keys(results).forEach((rule) => {
        const item = requirementsList.querySelector(`[data-rule="${rule}"]`);
        if (!item) return;

        const icon = item.querySelector('i');

        if (results[rule]) {
            item.classList.add('met');
            if (icon) {
                icon.classList.remove('fa-circle');
                icon.classList.add('fa-circle-check');
            }
        } else {
            item.classList.remove('met');
            if (icon) {
                icon.classList.remove('fa-circle-check');
                icon.classList.add('fa-circle');
            }
        }
    });
}

function validatePassword(passwordInput) {
    const results = checkPasswordRequirements(passwordInput.value);
    return Object.values(results).every(Boolean);
}
=======
    // TODO: Make the email error message disappear
}

>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a

function validateConfirmPassword(passwordInput, confirmPasswordInput) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
<<<<<<< HEAD

=======
    
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
    if (!confirmPassword) {
        showConfirmPasswordError(confirmPasswordInput, 'Please confirm your password');
        return false;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
    if (password !== confirmPassword) {
        showConfirmPasswordError(confirmPasswordInput, 'Passwords do not match');
        return false;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
    return true;
}

function showConfirmPasswordError(confirmPasswordInput, message) {
    clearConfirmPasswordError(confirmPasswordInput);

<<<<<<< HEAD
    const errorElement = document.createElement('p');
    errorElement.className = 'confirm-password-error';
    errorElement.textContent = message;

    confirmPasswordInput.closest('.password-wrapper').insertAdjacentElement('afterend', errorElement);
    confirmPasswordInput.style.borderColor = 'red';
=======
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
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
<<<<<<< HEAD

    const toggleIcon = wrapper.querySelector('.password-toggle');
    if (!toggleIcon) return;

    toggleIcon.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

=======
    
    const toggleIcon = wrapper.querySelector('.password-toggle');
    if (!toggleIcon) return;
    
    toggleIcon.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
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
<<<<<<< HEAD

    let isValid = true;

    if (emailInput && !validateEmail(emailInput)) {
        isValid = false;
    }

    if (passwordInput) {
        updatePasswordRequirements(passwordInput);
        if (!validatePassword(passwordInput)) {
            isValid = false;
        }
    }

    if (passwordInput && confirmPasswordInput && !validateConfirmPassword(passwordInput, confirmPasswordInput)) {
        isValid = false;
    }

    return isValid;
}
=======
    
    let isValid = true;
    
    if (emailInput && !validateEmail(emailInput)) {
        isValid = false;
    }
    
    if (passwordInput && confirmPasswordInput && !validateConfirmPassword(passwordInput, confirmPasswordInput)) {
        isValid = false;
    }
    
    return isValid;
}
>>>>>>> 4e21e7943f7c1ac1e5cda51f36138960a59bc20a
