document.addEventListener("DOMContentLoaded", function () {
    const profileForm = document.getElementById("profile-form");

    if (!profileForm) {
        return;
    }

    const fields = {
        name: document.getElementById("name"),
        apellidos: document.getElementById("apellidos"),
        telefono: document.getElementById("telefono"),
        email: document.getElementById("email"),
    };

    profileForm.addEventListener("submit", function (event) {
        if (!validateProfileForm()) {
            event.preventDefault();
        }
    });

    function setError(id, message) {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = message;
        }
    }

    function clearErrors() {
        setError("nameError", "");
        setError("apellidosError", "");
        setError("telefonoError", "");
        setError("emailError", "");
    }

    function validateProfileForm() {
        clearErrors();

        if (fields.name.value.trim() === "") {
            setError("nameError", "Por favor, introduce un nombre.");
            return false;
        }

        if (fields.apellidos.value.trim() === "") {
            setError("apellidosError", "Por favor, introduce apellidos.");
            return false;
        }

        if (!/^\d{9}$/.test(fields.telefono.value.trim())) {
            setError("telefonoError", "Introduce un teléfono de 9 dígitos.");
            return false;
        }

        if (fields.email.value.trim() === "") {
            setError("emailError", "Por favor, introduce un correo electrónico.");
            return false;
        }

        return true;
    }
});
