/*$(document).ready(function () {
    $("#update-info-ajax").click(function () {

        // Get data and save in a variable
        var nombre = document.getElementById("name").value;
        var localizacion = document.getElementById("localizacion").value;
        var tipologia = document.getElementById("tipologia").value;
        var periodo = document.getElementById("periodo").value;
        var subperiodo = document.getElementById("subperiodo").value;
        var descripcion = document.getElementById("descripcion").value;
        var link1 = document.getElementById("link1").value;
        var link2 = document.getElementById("link2").value;
        var link3 = document.getElementById("link3").value;
        var video1 = document.getElementById("video1").value;
        var video2 = document.getElementById("video2").value;
        var imagen = document.getElementById("imagen").value;
        var imagen_secundaria1 = document.getElementById("imagen_secundaria1").value;
        var imagen_secundaria2 = document.getElementById("imagen_secundaria2").value;
        var imagen_secundaria3 = document.getElementById("imagen_secundaria3").value;

        // Send data to PHP
        $.ajax({
            url: '../controller/LugaresController.php',
            type: 'POST',
            data: {
                "updatePlaceAjax":"true",
                nombre: nombre,
                localizacion: localizacion,
                tipologia: tipologia,
                periodo: periodo,
                subperiodo: subperiodo,
                descripcion: descripcion,
                link1: link1,
                link2: link2,
                link3: link3,
                video1: video1,
                video2: video2,
                imagen: imagen,
                imagen_secundaria1: imagen_secundaria1,
                imagen_secundaria2: imagen_secundaria2,
                imagen_secundaria3: imagen_secundaria3
            },
            success: function (response) {
                var parsedData = JSON.parse(response);

                if (parsedData.success) {
                    alert(parsedData.message);
                } else {
                    alert("Error: " + parsedData.message);
                }
            }
        });
    });
});*/

$(document).ready(function () {
    $("#update-info-ajax").click(function () {
        // Create a FormData object
        var formData = new FormData();

        // Get other data and append to FormData
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
        var imagen = document.getElementById("imagen").files[0];
        var imagen_secundaria1 = document.getElementById("imagen_secundaria1").files[0];
        var imagen_secundaria2 = document.getElementById("imagen_secundaria2").files[0];
        var imagen_secundaria3 = document.getElementById("imagen_secundaria3").files[0];

        if (imagen) formData.append("imagen", imagen);
        if (imagen_secundaria1) formData.append("imagen_secundaria1", imagen_secundaria1);
        if (imagen_secundaria2) formData.append("imagen_secundaria2", imagen_secundaria2);
        if (imagen_secundaria3) formData.append("imagen_secundaria3", imagen_secundaria3);

        // Send data to PHP
        $.ajax({
            url: '../controller/LugaresController.php',
            type: 'POST',
            data: formData,
            processData: false, // Important: Tell jQuery not to process the data
            contentType: false, // Important: Tell jQuery not to set content type
            success: function (response) {
                var parsedData = JSON.parse(response);

                if (parsedData.success) {
                    alert(parsedData.message);
                } else {
                    alert("Error: " + parsedData.message);
                }
            }
        });
    });
});