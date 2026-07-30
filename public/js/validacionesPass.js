document.addEventListener("DOMContentLoaded", function () {
    const passwordForm = document.getElementById("password-form");

    if (!passwordForm) {
        return;
    }

    passwordForm.addEventListener("submit", function (event) {
        if (!validatePasswordForm()) {
            event.preventDefault();
        }
    });

    function setError(id, message) {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = message;
        }
    }

    function validatePasswordForm() {
        const currentPasswordInput =
            document.getElementById("current_password");
        const newPasswordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById(
            "password_confirmation"
        );

        setError("currentPasswordError", "");
        setError("newPasswordError", "");
        setError("confirmPasswordError", "");

        if (currentPasswordInput.value.trim() === "") {
            setError("currentPasswordError", "Por favor, introduce tu contraseña actual.");
            return false;
        }

        if (newPasswordInput.value.trim() === "") {
            setError("newPasswordError", "Por favor, introduce una nueva contraseña.");
            return false;
        }

        if (newPasswordInput.value.length < 8) {
            setError("newPasswordError", "La contraseña debe tener al menos 8 caracteres.");
            return false;
        }

        if (confirmPasswordInput.value.trim() === "") {
            setError("confirmPasswordError", "Por favor, confirma tu nueva contraseña.");
            return false;
        }

        if (newPasswordInput.value !== confirmPasswordInput.value) {
            setError("confirmPasswordError", "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
            return false;
        }

        return true;
    }
});
