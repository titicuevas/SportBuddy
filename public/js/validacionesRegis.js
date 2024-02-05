document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("register-form");

    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            if (!validateRegisterForm()) {
                event.preventDefault();
            }
        });
    }

    function validateRegisterForm() {
        const nameInput = document.getElementById("name");
        const apellidosInput = document.getElementById("apellidos");
        const telefonoInput = document.getElementById("telefono");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById(
            "password_confirmation"
        );

        // Función para crear y mostrar mensajes de error
        function showError(inputElement, errorMessage, errorElementId) {
            // Elimina cualquier mensaje de error existente
            hideError(inputElement, errorElementId);

            // Crea un nuevo div para el mensaje de error
            const errorDiv = document.createElement("div");
            errorDiv.id = errorElementId;
            errorDiv.className = "text-sm text-red-600 mt-2";
            errorDiv.textContent = errorMessage;

            // Agrega el nuevo div al DOM, justo después del inputElement
            inputElement.parentNode.insertBefore(
                errorDiv,
                inputElement.nextSibling
            );
        }

        // Función para ocultar mensajes de error
        function hideError(inputElement, errorElementId) {
            const existingError = document.getElementById(errorElementId);

            // Verifica si el mensaje de error existe y lo elimina
            if (existingError) {
                existingError.remove();
            }
        }

        // Validación de nombre
        if (nameInput.value.trim() === "") {
            showError(
                nameInput,
                "Por favor, introduce un nombre.",
                "nameError"
            );
            return false;
        } else {
            hideError(nameInput, "nameError");
        }

        // Validación de apellidos
        if (apellidosInput.value.trim() === "") {
            showError(
                apellidosInput,
                "Por favor, introduce apellidos.",
                "apellidosError"
            );
            return false;
        } else {
            hideError(apellidosInput, "apellidosError");
        }

        // Validación de teléfono
        if (
            telefonoInput.value.trim() === "" ||
            !/^\d+$/.test(telefonoInput.value.trim())
        ) {
            showError(
                telefonoInput,
                "Por favor, introduce un teléfono válido.",
                "telefonoError"
            );
            return false;
        } else {
            hideError(telefonoInput, "telefonoError");
        }

        // Validación de correo electrónico
        if (emailInput.value.trim() === "") {
            showError(
                emailInput,
                "Por favor, introduce un correo electrónico.",
                "emailError"
            );
            return false;
        } else {
            hideError(emailInput, "emailError");
        }

        // Validación de contraseña
        if (passwordInput.value.trim() === "") {
            showError(
                passwordInput,
                "Por favor, introduce una contraseña.",
                "passwordError"
            );
            return false;
        } else {
            hideError(passwordInput, "passwordError");
        }

        // Validación de complejidad de la contraseña
        const passwordRegex =
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;

        if (!passwordRegex.test(passwordInput.value)) {
            showError(
                passwordInput,
                "La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial.",
                "passwordError"
            );
            return false;
        } else {
            hideError(passwordInput, "passwordError");
        }

        return true;
    }

    console.log(
        "El script de validación para el formulario de registro está funcionando correctamente."
    );
});
