export function validateName(nameInput) {
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

export function showNameError(nameInput, message) {
    clearNameError(nameInput);
    
    let nameErrorMessage = document.getElementById('name-error-message');
    nameErrorMessage.style.display = 'block';
    nameErrorMessage.textContent = message;
}

export function clearNameError(nameInput) {
    let nameErrorMessage = document.getElementById('name-error-message');
    nameErrorMessage.style.display = 'none';
    nameInput.classList.remove('error');
}

export function validateSubject(subjectInput) {
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

export function showSubjectError(subjectInput, message) {
    clearSubjectError(subjectInput);
    
    let subjectErrorMessage = document.getElementById('subject-error-message');
    subjectErrorMessage.style.display = 'block';
    subjectErrorMessage.textContent = message;
}

export function clearSubjectError(subjectInput) {
    let subjectErrorMessage = document.getElementById('subject-error-message');
    subjectErrorMessage.style.display = 'none';
    subjectInput.classList.remove('error');
}

export function validateConcern(concernInput) {
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

export function showConcernError(concernInput, message) {
    clearConcernError(concernInput);
    
    let concernErrorMessage = document.getElementById('concern-error-message');
    concernErrorMessage.style.display = 'block';
    concernErrorMessage.textContent = message;
}

export function clearConcernError(concernInput) {
    let concernErrorMessage = document.getElementById('concern-error-message');
    concernErrorMessage.style.display = 'none';
    concernInput.classList.remove('error');
}