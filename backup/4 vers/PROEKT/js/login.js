document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const emailField = document.getElementById('emailField');
    const passwordField = document.getElementById('passwordField');
    const emailError = document.getElementById('emailError');
    const emailInput = document.getElementById('username');
    const passwordInput = document.getElementById('password_label');
    const clueEmail = document.getElementById('clue');
    
    const testCredentials = {
        email: 'vasya@gmail.com',
        password: '77777'
    };
    
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        resetErrors();
        
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        
        if (!email || !password) {
            showError('Поля обязательные');
            if (!email) {
                emailField.classList.add('field-error');
                clueEmail.classList.add('login-form__description_error');
            }
            if (!password) {
                passwordField.classList.add('field-error');
            }
            return;
        }
   
        if (!validateEmail(email)) {
            showError('Неверный формат электропочты');
            emailField.classList.add('field-error');
            clueEmail.classList.add('login-form__description_error');
            return;
        }
        
        if (email !== testCredentials.email || password !== testCredentials.password) {
            showError('Не те логин или пароль...');
            emailField.classList.add('field-error');
            passwordField.classList.add('field-error');
            clueEmail.classList.add('login-form__description_error');
            return;
        }
        
        alert('Вход выполнен успешно!');
    });
    
    function resetErrors() {
        emailField.classList.remove('field-error');
        passwordField.classList.remove('field-error');
        emailError.classList.remove('error-message_visible');
        clueEmail.classList.remove('login-form__description_error');
    }
    
    function showError(message) {
        emailError.querySelector('.error-text').textContent = message;
        emailError.classList.add('error-message_visible');
    }
    
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});