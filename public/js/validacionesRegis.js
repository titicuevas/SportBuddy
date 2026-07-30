document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("register-form");

    if (!registerForm) {
        return;
    }

    registerForm.addEventListener("submit", function (event) {
        if (!validateRegisterForm()) {
            event.preventDefault();
        }
    });

    function showError(inputElement, errorMessage, errorElementId) {
        hideError(errorElementId);

        const errorDiv = document.createElement("div");
        errorDiv.id = errorElementId;
        errorDiv.className = "text-sm text-red-600 mt-2";
        errorDiv.textContent = errorMessage;
        inputElement.parentNode.insertBefore(errorDiv, inputElement.nextSibling);
    }

    function hideError(errorElementId) {
        document.getElementById(errorElementId)?.remove();
    }

    function validateRegisterForm() {
        const nameInput = document.getElementById("name");
        const apellidosInput = document.getElementById("apellidos");
        const telefonoInput = document.getElementById("telefono");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("password_confirmation");

        if (nameInput.value.trim() === "") {
            showError(nameInput, "Por favor, introduce un nombre.", "nameError");
            return false;
        }
        hideError("nameError");

        if (apellidosInput.value.trim() === "") {
            showError(apellidosInput, "Por favor, introduce apellidos.", "apellidosError");
            return false;
        }
        hideError("apellidosError");

        if (!/^\d{9}$/.test(telefonoInput.value.trim())) {
            showError(telefonoInput, "Introduce un teléfono de 9 dígitos.", "telefonoError");
            return false;
        }
        hideError("telefonoError");

        if (emailInput.value.trim() === "") {
            showError(emailInput, "Por favor, introduce un correo electrónico.", "emailError");
            return false;
        }
        hideError("emailError");

        if (passwordInput.value.length < 8) {
            showError(passwordInput, "La contraseña debe tener al menos 8 caracteres.", "passwordError");
            return false;
        }
        hideError("passwordError");

        if (passwordInput.value !== confirmPasswordInput.value) {
            showError(confirmPasswordInput, "Las contraseñas no coinciden.", "confirmPasswordError");
            return false;
        }
        hideError("confirmPasswordError");

        return true;
    }
});
