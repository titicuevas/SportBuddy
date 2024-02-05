document.addEventListener("DOMContentLoaded", function () {
    const passwordForm = document.querySelector("form");

    if (passwordForm) {
        passwordForm.addEventListener("submit", function (event) {
            if (!validatePasswordForm()) {
                event.preventDefault();
            }
        });
    }

    function validatePasswordForm() {
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById(
            "password_confirmation"
        );

        // Limpiar mensajes de error
        clearErrors();

        // Validación de correo electrónico
        if (isEmpty(emailInput)) {
            showError("email", "Por favor, introduce tu correo electrónico.");
            return false;
        }

        // Validación de contraseña
        if (isEmpty(passwordInput)) {
            showError("password", "Por favor, introduce una contraseña.");
            return false;
        }

        // Validación de complejidad de contraseña
        if (!isPasswordValid(passwordInput)) {
            showError(
                "password",
                "La contraseña debe cumplir con los requisitos."
            );
            return false;
        }

        // Validación de longitud mínima de contraseña
        if (!isLengthValid(passwordInput, 8)) {
            showError(
                "password",
                "La contraseña debe tener al menos 8 caracteres."
            );
            return false;
        }

        // Validación de confirmación de contraseña
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

    function isPasswordValid(input) {
        // Al menos una mayúscula, una minúscula, un carácter especial y un número
        const passwordRegex =
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;
        return passwordRegex.test(input.value);
    }

    function isLengthValid(input, length) {
        return input.value.length >= length;
    }

    function isEmpty(input) {
        return input.value.trim() === "";
    }

    function showError(inputId, message) {
        const errorElement = document.getElementById(`${inputId}Error`);
        errorElement.innerHTML = message;
        errorElement.style.display = "block";
    }

    function clearErrors() {
        const errorElements = document.querySelectorAll(".error-message");
        errorElements.forEach((element) => {
            element.innerHTML = "";
            element.style.display = "none";
        });
    }

    console.log(
        "El script de validación para cambio de contraseña está funcionando correctamente."
    );
});
