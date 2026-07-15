import { validateName, validateSubject, validateConcern, clearNameError, clearSubjectError, clearConcernError } from './field_validation.js';
import { validateEmail, clearEmailError } from './authentication.js';

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="contact_handler.php"]');

    const emailInput = form.querySelector('input[name="email"]');
    const nameInput = form.querySelector('input[name="name"]');
    const subjectInput = form.querySelector('input[name="subject"]');
    const concernInput = form.querySelector('textarea[name="message"]');

    // validate email
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            validateEmail(emailInput);
        });

        emailInput.addEventListener('input', function() {
            clearEmailError();
        });
    }

    if (nameInput) {
        nameInput.addEventListener('blur', function() {
            validateName(nameInput);
        });
        nameInput.addEventListener('input', function() {
            clearNameError(nameInput);
        });
    }
    
    if (subjectInput) {
        subjectInput.addEventListener('blur', function() {
            validateSubject(subjectInput);
        });
        subjectInput.addEventListener('input', function() {
            clearSubjectError(subjectInput);
        });
    }
    
    if (concernInput) {
        concernInput.addEventListener('blur', function() {
            validateConcern(concernInput);
        });
        concernInput.addEventListener('input', function() {
            clearConcernError(concernInput);
        });
    }

    form.addEventListener('submit', function(e) {
        if (!validateContactForm(form)) {
            e.preventDefault();
        }
    });
});

function validateContactForm(form) {
    const emailInput = form.querySelector('input[name="email"]');
    const nameInput = form.querySelector('input[name="name"]');
    const subjectInput = form.querySelector('input[name="subject"]');
    const concernInput = form.querySelector('textarea[name="message"]');
    
    let isValid = true;
    
    if (!validateEmail(emailInput)) {
        isValid = false;
    }
    
    if (!validateName(nameInput)) {
        isValid = false;
    }
    
    if (!validateSubject(subjectInput)) {
        isValid = false;
    }
    
    if (!validateConcern(concernInput)) {
        isValid = false;
    }
    
    return isValid;
}
