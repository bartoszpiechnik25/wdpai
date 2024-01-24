const form = document.querySelector('form');

const emailInput = form.querySelector('input[name="email"]');
const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');
const phoneNumberInput = form.querySelector('input[name="phone_number"]');

function isEmail(email) {
    return /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(email);
}

function isPhoneNumber(phoneNumber) {
    return /^\d{10}$/.test(phoneNumber);
}

function samePasswords(password, confirmed_password) {
    return password === confirmed_password;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('invalid'): element.classList.remove('invalid');
}

function validateEmail() {
    setTimeout()
}

emailInput.addEventListener('keyup', function() {
    setTimeout(function() {
        markValidation(emailInput, isEmail(emailInput.value))
    }, 1000);
});

confirmPasswordInput.addEventListener('keyup', function() {
    setTimeout(function() {
        const condition = samePasswords(
            confirmPasswordInput.previousElementSibling.value,
            confirmPasswordInput.value
        )
        markValidation(confirmPasswordInput, condition)
    }, 1000);
});

phoneNumberInput.addEventListener('keyup', function() {
    setTimeout(function() {
        markValidation(phoneNumberInput, isPhoneNumber(phoneNumberInput.value))
    }, 1000);
});