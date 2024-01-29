/* Formulario Admin Deporte */

function validateDeporteForm() {
    console.log("Iniciando la validación para el formulario de Deporte...");

    const nombreInput = document.getElementById("nombre");
    const nombreError = document.getElementById("nombreError");

    // Restablece el mensaje de error
    nombreError.textContent = "";

    if (nombreInput.value.trim() === "") {
        nombreError.textContent = "Por favor, introduce el nombre del deporte.";
        console.error("Error de validación: Nombre del deporte no ingresado");
        return;
    }

    // Otras validaciones según tus necesidades

    // Si pasa todas las validaciones, envía el formulario
    document.getElementById("deporteForm").submit();

    console.log(
        "Validación para el formulario de Deporte completada. Enviando formulario..."
    );
}

/* Formulario Admin Pista */

function validatePistaForm() {
    console.log("Iniciando la validación para el formulario de Pista...");

    const ubicacionId = document.getElementById("ubicacion_id");
    const numero = document.getElementById("numero");
    const precioConLuz = document.getElementById("precio_con_luz");
    const precioSinLuz = document.getElementById("precio_sin_luz");

    // Restablece los mensajes de error
    ubicacionId.setCustomValidity("");
    numero.setCustomValidity("");
    precioConLuz.setCustomValidity("");
    precioSinLuz.setCustomValidity("");

    // Validación de ubicación
    if (ubicacionId.value === "") {
        ubicacionId.setCustomValidity("Por favor, selecciona una ubicación.");
        console.error("Error de validación: Ubicación no seleccionada");
        return;
    }

    // Validación de número de pista
    if (numero.value.trim() === "") {
        numero.setCustomValidity("Por favor, introduce el número de la pista.");
        console.error("Error de validación: Número de pista no ingresado");
        return;
    }

    // Validación de precio con luz
    if (precioConLuz.value.trim() === "") {
        precioConLuz.setCustomValidity(
            "Por favor, introduce el precio con luz."
        );
        console.error("Error de validación: Precio con luz no ingresado");
        return;
    }

    // Validación de precio sin luz
    if (precioSinLuz.value.trim() === "") {
        precioSinLuz.setCustomValidity(
            "Por favor, introduce el precio sin luz."
        );
        console.error("Error de validación: Precio sin luz no ingresado");
        return;
    }

    // Si pasa todas las validaciones, envía el formulario
    document.getElementById("pistaForm").submit();

    console.log(
        "Validación para el formulario de Pista completada. Enviando formulario..."
    );

    /* Formulario Admin Superficie  */

    function validateSuperficieForm() {
        console.log(
            "Iniciando la validación para el formulario de Superficie..."
        );

        const tipoInput = document.getElementById("tipo");
        const tipoError = document.getElementById("tipoError");

        // Restablece el mensaje de error
        tipoError.textContent = "";

        if (tipoInput.value.trim() === "") {
            tipoError.textContent =
                "Por favor, introduce el tipo de superficie.";
            console.error(
                "Error de validación: Tipo de superficie no ingresado"
            );
            return;
        }

        // Si pasa todas las validaciones, envía el formulario
        document.getElementById("superficieForm").submit();

        console.log(
            "Validación para el formulario de Superficie completada. Enviando formulario..."
        );
    }

    /* Formulario Admin Ubicacion  */

    function validateUbicacionForm() {
        console.log(
            "Iniciando la validación para el formulario de Ubicación..."
        );

        const nombreInput = document.getElementById("nombre");
        const direccionInput = document.getElementById("direccion");
        const enlaceMapsInput = document.getElementById("enlace_maps");
        const imagenInput = document.getElementById("imagen");

        // Restablece los mensajes de error
        nombreInput.setCustomValidity("");
        direccionInput.setCustomValidity("");
        enlaceMapsInput.setCustomValidity("");
        imagenInput.setCustomValidity("");

        // Validación de nombre
        if (nombreInput.value.trim() === "") {
            nombreInput.setCustomValidity(
                "Por favor, introduce el nombre de la ubicación."
            );
            console.error(
                "Error de validación: Nombre de la ubicación no ingresado"
            );
            return false;
        }

        // Validación de dirección
        if (direccionInput.value.trim() === "") {
            direccionInput.setCustomValidity(
                "Por favor, introduce la dirección."
            );
            console.error("Error de validación: Dirección no ingresada");
            return false;
        }

        // Validación de enlace de Google Maps (opcional)
        if (enlaceMapsInput.value.trim() === "") {
            console.warn(
                "Advertencia: No se proporcionó enlace de Google Maps."
            );
        }

        // Validación de imagen
        if (!imagenInput.files || imagenInput.files.length === 0) {
            imagenInput.setCustomValidity("Por favor, selecciona una imagen.");
            console.error("Error de validación: Imagen no seleccionada");
            return false;
        }

        // Si pasa todas las validaciones, continúa con el envío del formulario
        console.log(
            "Validación para el formulario de Ubicación completada. Enviando formulario..."
        );
        return true;
    }
}
