$(document).ready(function () {
    $("#update-profile-ajax").click(function () {
        // Validar que todos los campos estén llenos
        var isValid = true;
        var requiredFields = ["userName", "ape1", "ape2", "password", "email", "tarjeta_credito"];
        requiredFields.forEach(function (field) {
            if (document.getElementById(field).value === "") {
                isValid = false;
                alert("El campo " + field + " es obligatorio.");
                return false; // Salir del bucle forEach
            }
        });

        // Validar el formato del email
        var email = document.getElementById("email").value;
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            alert("El formato del email es incorrecto.");
        }

        // Si no es válido, no enviar la solicitud
        if (!isValid) {
            return;
        }

        // Create a FormData object
        var formData = new FormData();

        // Get other data and append to FormData
        formData.append("updatePlaceAjax", "true");
        formData.append("userName", document.getElementById("userName").value);
        formData.append("ape1", document.getElementById("ape1").value);
        formData.append("ape2", document.getElementById("ape2").value);
        formData.append("password", document.getElementById("password").value);
        formData.append("email", document.getElementById("email").value);
        formData.append("tarjeta_credito", document.getElementById("tarjeta_credito").value);

        var imagen = document.getElementById("imagen");

        // Verificar si el elemento imagen existe
        if (imagen) {
            // Verificar si se ha seleccionado un archivo
            if (imagen.files.length > 0) {
                // Si se ha seleccionado un archivo, obtener el primer archivo
                var imagenFile = imagen.files[0];
                formData.append("imagen", imagenFile);
            } else {
                // Si no se ha seleccionado un archivo, dejar la variable "imagen" vacía
                formData.append("imagen", "");
            }
        } else {
            // Si el elemento imagen no existe, dejar la variable "imagen" vacía
            formData.append("imagen", "");
        }
        

        // Send data to PHP
        $.ajax({
            url: '../controller/UserController.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var parsedData = JSON.parse(response);
                if (parsedData.success) {
                    alert(parsedData.message);
                    window.location.href = 'profile.php';
                } else {
                    alert("Error: " + parsedData.message);
                    window.location.href = 'updateInfoProfile.php';
                }
            }
        });
    });
});