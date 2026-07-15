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

function showNameError(nameInput, message) {
    clearNameError(nameInput);
    
    let nameErrorMessage = document.getElementById('name-error-message');
    nameErrorMessage.style.display = 'block';
    nameErrorMessage.textContent = message;
}

function clearNameError(nameInput) {
    let nameErrorMessage = document.getElementById('name-error-message');
    nameErrorMessage.style.display = 'none';
    nameInput.classList.remove('error');
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

function showSubjectError(subjectInput, message) {
    clearSubjectError(subjectInput);
    
    let subjectErrorMessage = document.getElementById('subject-error-message');
    subjectErrorMessage.style.display = 'block';
    subjectErrorMessage.textContent = message;
}

function clearSubjectError(subjectInput) {
    let subjectErrorMessage = document.getElementById('subject-error-message');
    subjectErrorMessage.style.display = 'none';
    subjectInput.classList.remove('error');
}

function validateConcern(concernInput) {
    const concern = concernInput.value.trim();
    
    if (!concern) {
        showConcernError(concernInput, 'Concern is required.');
        return false;
    }
    
    if (concern.length < 10) {
        showConcernError(concernInput, 'Concern must be at least 10 characters long.');
        return false;
    }
    
    return true;
}

function showConcernError(concernInput, message) {
    clearConcernError(concernInput);
    
    let concernErrorMessage = document.getElementById('concern-error-message');
    concernErrorMessage.style.display = 'block';
    concernErrorMessage.textContent = message;
}

function clearConcernError(concernInput) {
    let concernErrorMessage = document.getElementById('concern-error-message');
    concernErrorMessage.style.display = 'none';
    concernInput.classList.remove('error');
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
