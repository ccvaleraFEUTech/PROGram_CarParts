// Hides the  error message under the input field
export function hideFieldError(elementId) {
    let errorMessageElement = document.getElementById(elementId);
    errorMessageElement.style.display = 'none';
    
    errorMessageElement.classList.remove('error');
}

export function showFieldError(elementId, textContent) {
    let errorMessageElement = document.getElementById(elementId);
    errorMessageElement.style.display = 'block';
    errorMessageElement.textContent = textContent;
    
    errorMessageElement.classList.add('error');
}
