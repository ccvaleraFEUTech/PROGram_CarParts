import { showFieldError, hideFieldError } from './field_validation.js';
import { validateEmail } from './authentication.js';

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="contact_handler.php"]');

    const emailInput = form.querySelector('input[name="email"]');
    const nameInput = form.querySelector('input[name="name"]');
    const subjectInput = form.querySelector('input[name="subject"]');
    const concernInput = form.querySelector('textarea[name="message"]');

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
            hideNameError();
        });
    }
    
    if (subjectInput) {
        subjectInput.addEventListener('blur', function() {
            validateSubject(subjectInput);
        });
        subjectInput.addEventListener('input', function() {
            hideSubjectError();
        });
    }
    
    if (concernInput) {
        concernInput.addEventListener('blur', function() {
            validateConcern(concernInput);
        });
        concernInput.addEventListener('input', function() {
            clearConcernError();
        });
    }

    form.addEventListener('submit', function(e) {
        if (!validateContactForm(form)) {
            e.preventDefault();
        }
    });
});

function validateName(nameInput) {
    const name = nameInput.value.trim();
    
    if (!name) {
        showNameError(nameInput, 'Name is required.');
        return false;
    }
    
    if (name.length < 2) {
        showNameError(nameInput, 'Name must be at least 2 characters long.');
        return false;
    }
    
    return true;
}

function showNameError(message) {
    showFieldError('name-error-message', message);
}

function hideNameError() {
    hideFieldError('name-error-message');
}

function validateSubject(subjectInput) {
    const subject = subjectInput.value.trim();
    
    if (!subject) {
        showSubjectError(subjectInput, 'Subject is required.');
        return false;
    }
    
    if (subject.length < 5) {
        showSubjectError(subjectInput, 'Subject must be at least 5 characters long.');
        return false;
    }
    
    return true;
}

function showSubjectError(message) {
    showFieldError('subject-error-message', message);
}

function hideSubjectError() {
    hideFieldError('subject-error-message');
}

function validateConcern(concernInput) {
    const concern = concernInput.value.trim();
    
    if (!concern) {
        showConcernError('Concern is required.');
        return false;
    }
    
    if (concern.length < 10) {
        showConcernError('Concern must be at least 10 characters long.');
        return false;
    }
    
    return true;
}

function showConcernError(message) {
    hideFieldError("concern-error-message");
    showFieldError("concern-error-message", message);
}

function clearConcernError() {
    hideFieldError('concern-error-message');
}

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
