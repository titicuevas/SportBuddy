document.addEventListener("DOMContentLoaded", function () {
    const profileForm = document.getElementById("profile-form");

    if (profileForm) {
        profileForm.addEventListener("submit", function (event) {
            if (!validateProfileForm()) {
                event.preventDefault();
            }
        });
    }

    function validateProfileForm() {
        const nameInput = document.getElementById("name");
        const apellidosInput = document.getElementById("apellidos");
        const telefonoInput = document.getElementById("telefono");
        const emailInput = document.getElementById("email");

        // Limpiar mensajes de error
        document.getElementById("nameError").innerHTML = "";
        document.getElementById("apellidosError").innerHTML = "";
        document.getElementById("telefonoError").innerHTML = "";
        document.getElementById("emailError").innerHTML = "";

        // Validación de nombre
        if (nameInput.value.trim() === "") {
            document.getElementById("nameError").innerHTML =
                "Por favor, introduce un nombre.";
            return false;
        }

        // Validación de apellidos
        if (apellidosInput.value.trim() === "") {
            document.getElementById("apellidosError").innerHTML =
                "Por favor, introduce apellidos.";
            return false;
        }

        // Validación de teléfono
        if (telefonoInput.value.trim() === "") {
            document.getElementById("telefonoError").innerHTML =
                "Por favor, introduce un teléfono.";
            return false;
        }

        // Validación de correo electrónico
        if (emailInput.value.trim() === "") {
            document.getElementById("emailError").innerHTML =
                "Por favor, introduce un correo electrónico.";
            return false;
        }

        return true;
    }

    console.log(
        "El script de validación para datos de usuarios está funcionando correctamente."
    );

    /* Validaciones Registro */

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

            // Validación de nombre
            if (nameInput.value.trim() === "") {
                alert("Por favor, introduce un nombre.");
                return false;
            }

            // Validación de apellidos
            if (apellidosInput.value.trim() === "") {
                alert("Por favor, introduce apellidos.");
                return false;
            }

            // Validación de teléfono
            if (telefonoInput.value.trim() === "") {
                alert("Por favor, introduce un teléfono.");
                return false;
            }

            // Validación de correo electrónico
            if (emailInput.value.trim() === "") {
                alert("Por favor, introduce un correo electrónico.");
                return false;
            }

            /* Validaciones contraseñas */

            // Validación de longitud mínima de contraseña
            if (passwordInput.value.length < 8) {
                alert("La contraseña debe tener al menos 8 caracteres.");
                return false;
            }

            // Validación de complejidad de contraseña
            const passwordPattern =
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/;
            if (!passwordPattern.test(passwordInput.value)) {
                alert(
                    "La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial."
                );
                return false;
            }

            // Validación de confirmación de contraseña
            if (confirmPasswordInput.value.trim() === "") {
                alert("Por favor, confirma tu contraseña.");
                return false;
            }

            // Validación de coincidencia de contraseña y confirmación de contraseña
            if (passwordInput.value !== confirmPasswordInput.value) {
                alert(
                    "Las contraseñas no coinciden. Por favor, inténtalo de nuevo."
                );
                return false;
            }

            // Puedes agregar más validaciones según tus necesidades

            return true;
        }

        console.log(
            "El script de validación para el formulario de registro está funcionando correctamente."
        );
    });
});
