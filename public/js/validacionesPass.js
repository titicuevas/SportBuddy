document.addEventListener("DOMContentLoaded", function () {
    const passwordForm = document.getElementById("password-form");

    if (passwordForm) {
        passwordForm.addEventListener("submit", function (event) {
            if (!validatePasswordForm()) {
                event.preventDefault();
            }
        });
    }

    function validatePasswordForm() {
        const currentPasswordInput =
            document.getElementById("current_password");
        const newPasswordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById(
            "password_confirmation"
        );

        // Limpiar mensajes de error
        document.getElementById("currentPasswordError").innerHTML = "";
        document.getElementById("newPasswordError").innerHTML = "";
        document.getElementById("confirmPasswordError").innerHTML = "";

        // Validación de contraseña actual
        if (currentPasswordInput.value.trim() === "") {
            document.getElementById("currentPasswordError").innerHTML =
                "Por favor, introduce tu contraseña actual.";
            return false;
        }

        // Validación de nueva contraseña
        if (newPasswordInput.value.trim() === "") {
            document.getElementById("newPasswordError").innerHTML =
                "Por favor, introduce una nueva contraseña.";
            return false;
        }

        // Validación de longitud mínima de contraseña
        if (newPasswordInput.value.length < 8) {
            document.getElementById("newPasswordError").innerHTML =
                "La contraseña debe tener al menos 8 caracteres.";
            return false;
        }

        // Validación de confirmación de contraseña
        if (confirmPasswordInput.value.trim() === "") {
            document.getElementById("confirmPasswordError").innerHTML =
                "Por favor, confirma tu nueva contraseña.";
            return false;
        }

        if (newPasswordInput.value !== confirmPasswordInput.value) {
            document.getElementById("confirmPasswordError").innerHTML =
                "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
            return false;
        }

        // Puedes agregar más validaciones según tus necesidades

        return true;
    }

    console.log(
        "El script de validación para cambio de contraseña está funcionando correctamente."
    );
});
