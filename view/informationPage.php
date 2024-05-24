<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Page</title>
    <link rel="stylesheet" href="informationPage.css">
</head>

<header>
    <div id="div-header">
        <div id="div-img-logo">
            <img id="img-logo" src="../view/img/Logo Final.png">
        </div>
        <div id="div-project-name">
            <p id="project-name">ArchaeoTours</p>
        </div>
        <div id="div-header-menu">
            <div id="div-reference-middle">
            </div>
            <div class="div-menu">
                <a class="header-menu" href="mainPage.php">Home</a>
            </div>
            <div class="div-menu">
            <a class="header-menu" href="aboutUs.php">About Us</a>
            </div>
            <div class="div-menu">
                <a class="header-menu" href="profile.php">Profile</a>
            </div>
            <div class="div-menu">
                <a class="header-menu" href="loginRegister.php">Login / Register</a>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="head">
        <h1 id="title"><?php echo isset($_SESSION["name"]) ? $_SESSION["name"] : '<em>Not found</em>'; ?></h2>
        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Admin') : ?>
        <form method="post" action="updateInfoPlace.php">
            <button type="submit" id="edit-place" name="edit-place">Edit Place</button>
        </form>
        <?php endif; ?>
    </div>
    <div id="grid-div">
        <div id="place-img">
            <img id="main-place-img" src="<?php echo isset($_SESSION["imagen"]) ? $_SESSION["imagen"] : '<em>Not found</em>'; ?>"></img>
        </div>
        <div id="div-description1">
            <p><strong>Location: </strong><?php echo isset($_SESSION["localizacion"]) ? $_SESSION["localizacion"] : '<em>Not found</em>'; ?></p>
            <p><strong>Typology: </strong><?php echo isset($_SESSION["tipologia"]) ? $_SESSION["tipologia"] : '<em>Not found</em>'; ?></p>
            <p><strong>Period: </strong><?php echo isset($_SESSION["periodo"]) ? $_SESSION["periodo"] : '<em>Not found</em>'; ?></p>
            <p><strong>Subperiod: </strong><?php echo isset($_SESSION["subperiodo"]) ? $_SESSION["subperiodo"] : '<em>Not found</em>'; ?></p>
        </div>
        <div id="div-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28474.067495524938!2d2.189001257490275!3d41.396508673532814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a49816718e30e5%3A0x44b0fb3d4f47660a!2sBarcelona!5e0!3m2!1ses!2ses!4v1706868219665!5m2!1ses!2ses" width="100%" height="100%" style="border: 2px solid #000;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div id="div-img1">
            <img class="secundary-place-img" src="<?php echo isset($_SESSION["imagen_secundaria1"]) ? $_SESSION["imagen_secundaria1"] : '<em>Not found</em>'; ?>"></img>
        </div>
        <div id="div-img2">
            <img class="secundary-place-img" src="<?php echo isset($_SESSION["imagen_secundaria2"]) ? $_SESSION["imagen_secundaria2"] : '<em>Not found</em>'; ?>"></img>
        </div>
        <div id="div-img3">
            <img class="secundary-place-img" src="<?php echo isset($_SESSION["imagen_secundaria3"]) ? $_SESSION["imagen_secundaria3"] : '<em>Not found</em>'; ?>"></img>
        </div>
        <div id="div-description2">
            <p><?php echo isset($_SESSION["descripcion"]) ? $_SESSION["descripcion"] : '<em>Not found</em>'; ?></p>
        </div>
        <div id="div-links">
            <p>External resources:</p>
            <li>
                <a href="<?php echo isset($_SESSION["link1"]) ? $_SESSION["link1"] : '<em>Not found</em>'; ?>">Link 1</a>
            </li>
            <li>
                <a href="<?php echo isset($_SESSION["link2"]) ? $_SESSION["link2"] : '<em>Not found</em>'; ?>">Link 2</a>
            </li>
            <li>
                <a href="<?php echo isset($_SESSION["link3"]) ? $_SESSION["link3"] : '<em>Not found</em>'; ?>">Link 3</a>
            </li>
        </div>
        <div id="div-video1">
            <iframe width="560" height="315" src="<?php echo isset($_SESSION["video1"]) ? $_SESSION["video1"] : ''; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            
        </div>
        <div id="div-video2">
            <iframe width="560" height="315" src="<?php echo isset($_SESSION["video2"]) ? $_SESSION["video2"] : ''; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="div-reviews" id="div-review1">
            <div class="review-img">
                <img class="user-img" src="../view/img/mujer.png"></img>
            </div>
            <div class="review-title">
                <p>Marta</p>
            </div>
            <div class="review-commentary">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                    aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia deserunt mollit
                    anim id est laborum.</p>
            </div>
        </div>
        <div class="div-reviews" id="div-review2">
            <div class="review-img">
                <img class="user-img" src="../view/img/hombre.png"></img>
            </div>
            <div class="review-title">
                <p>Pedro</p>
            </div>
            <div class="review-commentary">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                    aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia deserunt mollit
                    anim id est laborum.</p>
            </div>
        </div>
    </div>
</body>

<footer>
    <div id="footer">
        <div id="div-footer"></div>
        <div id="div-stores">
            <a href="#"><img id="apple" src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"></a>
            <a href="#"><img id="android" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/2560px-Google_Play_Store_badge_EN.svg.png"></a>
            <a href="#"><img id="microsoft" src='https://developer.microsoft.com/en-us/store/badges/images/English_get-it-from-MS.png'></a>
        </div>
        <div id="container">
            <div id="copyright">
                Copyright &copy; 2024 <strong><span>ArchaeoTours</span></strong>. All Rights Reserved
            </div>
        </div>
    </div>
</footer>
</html>