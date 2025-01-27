// FETCH
const form = document.querySelector('form');
const emailInput = form.querySelector('input[name="email"]');
const confirmPasswordInput = form.querySelector('input[name="confirmPassword"]');

function isEmailValid(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsTheSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail() {
    setTimeout(function() {
        markValidation(emailInput, isEmailValid(emailInput.value))
    }, 1000);
}

function validatePassword() {

    setTimeout(function() {
        const condition = arePasswordsTheSame(confirmPasswordInput.previousElementSibling.value, confirmPasswordInput.value);
        markValidation(confirmPasswordInput, condition);
    }, 1000);
}

emailInput.addEventListener('keyup', validateEmail);

confirmPasswordInput.addEventListener('keyup', validatePassword);
