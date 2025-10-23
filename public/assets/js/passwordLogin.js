//Ver la password
function verPassword() {
    const campoPassword = document.getElementById('password');
    const iconPassword = document.getElementById('iconPassword');
    const passwordVisible = campoPassword.type === 'text';

    campoPassword.type = passwordVisible ? 'password' : 'text';
    iconPassword.classList.toggle('fa-eye');
    iconPassword.classList.toggle('fa-eye-slash');
}