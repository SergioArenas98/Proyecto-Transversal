$(document).ready(function () {
    $("#update-profile-ajax").click(function () {
        // Validate that all fields are filled
        var isValid = true;
        var requiredFields = ["userName", "ape1", "ape2", "password", "email", "tarjeta_credito"];
        requiredFields.forEach(function (field) {
            if (document.getElementById(field).value === "") {
                isValid = false;
                alert("Field " + field + " is required.");
                // Exit the loop
                return false;
            }
        });

        // Validate email format
        var email = document.getElementById("email").value;
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            alert("Invalid email format.");
        }

        // If not valid, don't send the request
        if (!isValid) {
            return;
        }

        var formData = new FormData();

        // Get data and append to FormData
        formData.append("updatePlaceAjax", "true");
        formData.append("userName", document.getElementById("userName").value);
        formData.append("ape1", document.getElementById("ape1").value);
        formData.append("ape2", document.getElementById("ape2").value);
        formData.append("password", document.getElementById("password").value);
        formData.append("email", document.getElementById("email").value);
        formData.append("tarjeta_credito", document.getElementById("tarjeta_credito").value);

        var imagen = document.getElementById("imagen");

        // Check if the image exists
        if (imagen) {
            // Check if a file has been selected
            if (imagen.files.length > 0) {
                // If a file has been selected, get the first file
                var imagenFile = imagen.files[0];
                formData.append("imagen", imagenFile);
            } else {
                // If no file has been selected, leave variable empty
                formData.append("imagen", "");
            }
        } else {
            // If the image element does not exist, leave variable empty
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
                // If update is successful
                if (parsedData.success) {
                    alert(parsedData.message);
                    window.location.href = 'profile.php';
                // If update is unsuccessful
                } else {
                    alert("Error: " + parsedData.message);
                    window.location.href = 'updateInfoProfile.php';
                }
            }
        });
    });
});