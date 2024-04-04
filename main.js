function removeErrorMessage() {
    var errorMessage = document.querySelector('.error-msg');
    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.display = 'none';
        }, 3000); // 3000 milliseconds (3 seconds)
    }
}

// Call the function when the page loads
window.onload = removeErrorMessage;


function removeSuccessMesssage() {
    var successMessage = document.querySelector('.success-msg');
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 3000); // 3000 milliseconds (3 seconds)
    }
}

// Call the function when the page loads
window.onload = removeSuccessMesssage;