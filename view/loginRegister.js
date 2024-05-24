
$('#accept-cookies').click(function () {
    localStorage.setItem("cookiesAccepted", "true");
    $('#cookies').hide();
});

if (localStorage.getItem("cookiesAccepted") === "true") {
    $('#cookies').hide();
} else {
    $('#cookies').show();
}

$("#sliderSites").slick({
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    dots: false,
    responsive: [
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
                arrows: false,
                dots: true
            }
        }
    ]
})

$("#sliderPeriods").slick({
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    dots: false,
    responsive: [
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
                arrows: false,
                dots: true
            }
        }
    ]
})
$("#form").validate({
    rules: {
        name_login: {
            required: true,
            minlength: 1,
            maxlength: 20
        },
        password_login: {
            required: true,
            minlength: 5,
            maxlength: 20,
            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z\s]).{5,}$/
        },
        name_admin: {
            required: true,
            minlength: 1,
            maxlength: 20
        },
        email_admin: {
            required: true,
            minlength: 1,
            maxlength: 30
        },
        password_admin: {
            required: true,
            minlength: 5,
            maxlength: 20,
            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z\s]).{5,}$/
        },
        img_admin: {
            required: true
        },
        name_user: {
            required: true,
            minlength: 1,
            maxlength: 20
        },
        email_user: {
            required: true,
            minlength: 1,
            maxlength: 30
        },
        password_user: {
            required: true,
            minlength: 5,
            maxlength: 20,
            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z\s]).{5,}$/
        },
        img_user: {
            required: true
        }
    },
    messages: {
        name_login: {
            required: "<br>Inserte un nombre<br>",
            minlength: "<br>El mínimo es de 1<br>",
            maxlength: "<br>El máximo es de 20<br>"
        },
        password_login: {
            required: "<br>Inserte una contraseña<br>",
            minlength: "<br>El mínimo es de 5<br>",
            maxlength: "<br>El máximo es de 20<br>",
            pattern: "<br>Solo letras (mayúsculas o minúsculas)<br>"
        },
        name_admin: {
            required: "<br>Inserte un nombre de administrador<br>",
            minlength: "<br>El mínimo es de 1<br>",
            maxlength: "<br>El máximo es de 20<br>"
        },
        email_admin: {
            required: "<br>Inserte un email<br>",
            minlength: "<br>El mínimo es de 1<br>",
            maxlength: "<br>El máximo es de 30<br>"
        },
        password_admin: {
            required: "<br>Inserte una contraseña<br>",
            minlength: "<br>El mínimo es de 5<br>",
            maxlength: "<br>El máximo es de 20<br>",
            pattern: "<br>Solo letras (mayúsculas o minúsculas)<br>"
        },
        img_admin: {
            required: "<br>Inserte una imagen<br>"
        },
        name_user: {
            required: "<br>Inserte un nombre de usuario<br>",
            minlength: "<br>El mínimo es de 1<br>",
            maxlength: "<br>El máximo es de 20<br>"
        },
        email_user: {
            required: "<br>Inserte un email<br>",
            minlength: "<br>El mínimo es de 1<br>",
            maxlength: "<br>El máximo es de 30<br>"
        },
        password_user: {
            required: "<br>Inserte una constraseña<br>",
            minlength: "<br>El mínimo es de 5<br>",
            maxlength: "<br>El máximo es de 20<br>",
            pattern: "<br>Solo letras (mayúsculas o minúsculas)<br>"
        },
        img_user: {
            required: "<br>Inserte una imagen<br>"
        }
    }
});

$(document).ready(function () {
    // Event listener for email input field when focus leaves
    $('.email-input').on('focusout', function () {
        var email = $(this).val();
        var inputField = $(this);
        if (email.length > 0) {
            $.ajax({
                url: '../controller/checkEmail.php',
                type: 'POST',
                data: { email: email },
                success: function (response) {
                    if (response.exists) {
                        if (!inputField.next('.error').length) {
                            inputField.after('<br class="error"><span class="error">Email already registered</span><br class="error">');
                        }
                    } else {
                        inputField.nextAll('.error').remove();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            inputField.nextAll('.error').remove();
        }
    });
});
