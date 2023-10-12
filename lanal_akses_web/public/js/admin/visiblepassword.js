document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    const showPassword = document.getElementById('show-password');

    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const eyeIconConfirmation = document.getElementById('eye-icon-confirmation');
    const showPasswordConfirmation = document.getElementById('show-password-confirmation');

    showPassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });

    showPasswordConfirmation.addEventListener('click', function () {
        if (passwordConfirmationInput.type === 'password') {
            passwordConfirmationInput.type = 'text';
            eyeIconConfirmation.classList.remove('fa-eye');
            eyeIconConfirmation.classList.add('fa-eye-slash');
        } else {
            passwordConfirmationInput.type = 'password';
            eyeIconConfirmation.classList.remove('fa-eye-slash');
            eyeIconConfirmation.classList.add('fa-eye');
        }
    });
});