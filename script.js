document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting

    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementsByName('lname')[0].value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const gender = document.getElementById('gender').value;
    const password = document.getElementsByName('password')[0].value.trim();
    const confirmPassword = document.getElementsByName('conpassword')[0].value.trim();
    const terms = document.getElementById('terms').checked;

    // Remove previous error messages
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function(message) {
        message.remove();
    });

    let hasError = false;

    function showError(input, message) {
        const error = document.createElement('div');
        error.className = 'error-message';
        error.textContent = message;
        input.parentNode.appendChild(error);
        input.classList.add('error-border');
        hasError = true;
    }

    if (firstName === '') {
        showError(document.getElementById('firstName'), 'First Name is required.');
    }

    if (lastName === '') {
        showError(document.getElementsByName('lname')[0], 'Last Name is required.');
    }

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        showError(document.getElementById('email'), 'Invalid email format.');
    }

    const phonePattern = /^\d{10}$/;
    if (!phonePattern.test(phone)) {
        showError(document.getElementById('phone'), 'Phone number must be 10 digits.');
    }

    if (address === '') {
        showError(document.getElementById('address'), 'Address is required.');
    }

    if (gender === '') {
        showError(document.getElementById('gender'), 'Gender is required.');
    }

    if (password === '') {
        showError(document.getElementsByName('password')[0], 'Password is required.');
    } else if (password.length < 6) {
        showError(document.getElementsByName('password')[0], 'Password must be at least 6 characters.');
    }

    if (confirmPassword === '') {
        showError(document.getElementsByName('conpassword')[0], 'Confirm Password is required.');
    } else if (password !== confirmPassword) {
        showError(document.getElementsByName('conpassword')[0], 'Passwords do not match.');
    }

    if (!terms) {
        showError(document.getElementById('terms').parentNode, 'You must agree to the terms and conditions.');
    }

    if (!hasError) {
        document.getElementById('registrationForm').submit();
    }
});
