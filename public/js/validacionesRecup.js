document.addEventListener("DOMContentLoaded", function () {
    const passwordForm = document.querySelector("form[action$='reset-password']");

    if (!passwordForm) {
        return;
    }

    passwordForm.addEventListener("submit", function (event) {
        if (!validatePasswordForm()) {
            event.preventDefault();
        }
    });

    function validatePasswordForm() {
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById(
            "password_confirmation"
        );

        clearErrors();

        if (isEmpty(emailInput)) {
            showError("email", "Por favor, introduce tu correo electrónico.");
            return false;
        }

        if (isEmpty(passwordInput)) {
            showError("password", "Por favor, introduce una contraseña.");
            return false;
        }

        if (!isLengthValid(passwordInput, 8)) {
            showError(
                "password",
                "La contraseña debe tener al menos 8 caracteres."
            );
            return false;
        }

        if (isEmpty(confirmPasswordInput)) {
            showError("confirmPassword", "Por favor, confirma tu contraseña.");
            return false;
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            showError(
                "confirmPassword",
                "Las contraseñas no coinciden. Por favor, inténtalo de nuevo."
            );
            return false;
        }

        return true;
    }

    function isLengthValid(input, length) {
        return input.value.length >= length;
    }

    function isEmpty(input) {
        return input.value.trim() === "";
    }

    function showError(inputId, message) {
        const errorElement = document.getElementById(`${inputId}Error`);
        if (errorElement) {
            errorElement.textContent = message;
        }
    }

    function clearErrors() {
        ["emailError", "passwordError", "confirmPasswordError"].forEach((id) => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = "";
            }
        });
    }
});
