$(document).ready(function () {
    $("#update-info-ajax").click(function () {
        // Validate that all fields are filled
        var isValid = true;
        var requiredFields = ["name", "localizacion", "tipologia", "periodo", "subperiodo", "descripcion", "link1", "link2", "link3", "video1", "video2"];
        requiredFields.forEach(function (field) {
            if (document.getElementById(field).value === "") {
                isValid = false;
                alert("El campo " + field + " es obligatorio.");
                return false; // Salir del bucle forEach
            }
        });

        // Validate that all images are selected
        var imagen = document.getElementById("imagen").files[0];
        var imagen_secundaria1 = document.getElementById("imagen_secundaria1").files[0];
        var imagen_secundaria2 = document.getElementById("imagen_secundaria2").files[0];
        var imagen_secundaria3 = document.getElementById("imagen_secundaria3").files[0];

        if (!imagen || !imagen_secundaria1 || !imagen_secundaria2 || !imagen_secundaria3) {
            isValid = false;
            alert("Debe seleccionar todas las imágenes.");
        }

        // If not valid, don't send the request
        if (!isValid) {
            return;
        }

        var formData = new FormData();

        // Get data and append to FormData
        formData.append("updatePlaceAjax", "true");
        formData.append("nombre", document.getElementById("name").value);
        formData.append("localizacion", document.getElementById("localizacion").value);
        formData.append("tipologia", document.getElementById("tipologia").value);
        formData.append("periodo", document.getElementById("periodo").value);
        formData.append("subperiodo", document.getElementById("subperiodo").value);
        formData.append("descripcion", document.getElementById("descripcion").value);
        formData.append("link1", document.getElementById("link1").value);
        formData.append("link2", document.getElementById("link2").value);
        formData.append("link3", document.getElementById("link3").value);
        formData.append("video1", document.getElementById("video1").value);
        formData.append("video2", document.getElementById("video2").value);

        // Get images and append to FormData
        formData.append("imagen", imagen);
        formData.append("imagen_secundaria1", imagen_secundaria1);
        formData.append("imagen_secundaria2", imagen_secundaria2);
        formData.append("imagen_secundaria3", imagen_secundaria3);

        // Send data to PHP
        $.ajax({
            url: '../controller/LugaresController.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var parsedData = JSON.parse(response);

                if (parsedData.success) {
                    alert(parsedData.message);
                    window.location.href = 'informationPage.php';
                } else {
                    alert("Error: " + parsedData.message);
                    window.location.href = 'updateInfoPlace.php';
                }
            }
        });
    });
});