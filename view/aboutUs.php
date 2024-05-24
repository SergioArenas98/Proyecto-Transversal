<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="aboutUs.css">
  <title>About Us</title>
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
        <h1 id="title">ABOUT US</h2>
    </div>
    <div id="main-img">
        <img id="main-place-img" src="../view/img/skyline_bcn.jpg"></img>
    </div>
    <div id="div-grid">
        <div id="grid1-left">
            <img id="person-img" src="../view/img/hombre.png"></img>
        </div>
        <div id="grid2-left">
            <img id="person-img" src="../view/img/hombre.png"></img>
        </div>
        <div id="grid3-left">
            <img id="person-img" src="../view/img/hombre.png"></img>
        </div>
        <div id="grid1-right">
            <p class="about-us">I'm Sergio Arenas, one of the three ArchaeoTours cofounders. With a university degree in Archaeology and a master's degree in Biological 
                Anthropology, my passion for human evolution and the study of human anatomy has led me to dedicate my professional life to the fascinating 
                world of historical and archaeological tourism. From my early academic training to my experience in the field, I have gained a deep knowledge 
                of history and culture, especially in the context of Barcelona, a city rich in historical and archaeological heritage. My aim with ArchaeoTours 
                is to offer visitors a unique and personalised experience that allows them to immerse themselves in the fascinating past of this iconic city.
                With my specialisation in prehistoric archaeology, I am particularly equipped to guide travellers through the early human settlements and the 
                traces left by our ancient civilisations. 
                </p>
        </div>
        <div id="grid2-right">
            <p class="about-us">Hello! I'm Gerard, the ArchaeoTours cofounder. At 26 years old and with a burning passion for archaeology, I decided to combine 
                my academic knowledge with my skills in computer programming to create a platform that revolutionises the way we experience historical and 
                archaeological tourism in the vibrant city of Barcelona. Since studying my degree in archaeology at university, I've always been fascinated by
                the mysteries of the past and how they influence our present. This fascination led me to delve deeper into the study of Barcelona's history and 
                culture, a city steeped in history at every turn. My background in archaeology has given me a profound understanding of the city's historical 
                and archaeological contexts, while my skills in computer programming have enabled me to develop a platform dedicated to offering personalised 
                historical and archaeological tourism experiences, allowing travellers to immerse themselves in Barcelona's fascinating history in a dynamic and enriching way.</p>
        </div>
        <div id="grid3-right">
            <p class="about-us">My name is Daniel Naranjo, and along with a team passionate about history and technology, we have created ArchaeoTours with a clear 
                purpose in mind: to enrich your cultural and tourist experience by guiding you through the most iconic and captivating corners of this historical 
                gem. As a student of multiplatform application development, my fascination with the intersection of history and technology led me to undertake 
                this project. Barcelona, a city with a wealth of heritage spanning millennia, deserves to be explored with depth and understanding. However, 
                we realised that scattered information and the lack of a dedicated platform made it difficult for travellers to discover, understand, and fully 
                appreciate its historical and archaeological value. With ArchaeoTours, we not only seek to fill that gap in the market but also to contribute to 
                preserving and promoting Barcelona's historical and archaeological richness for future generations.</p>
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