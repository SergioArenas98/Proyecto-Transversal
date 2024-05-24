<?php
session_start();
if (isset($_SESSION['error'])) {
  echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
  echo $_SESSION['nombre'];
  unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="createPlace.css">
  <title>Create Place</title>
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
      <div id="div-reference-middle"></div>
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
  <div id="main-div">
    <div id="div-info2">
      <h2 id="title-info">Create Place</h2>
      <div id="profileFormRead">
        <div id="profileFormUpdate">
          <form id="read_profile" action="../controller/LugaresController.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Name:</label>
            <input type="text" id="nombre" name="nombre"><br><br>

            <label for="localizacion">Location:</label>
            <input type="text" id="localizacion" name="localizacion"><br><br>

            <label for="tipologia">Typology:</label>
            <input type="text" id="tipologia" name="tipologia"><br><br>

            <label for="periodo">Period:</label>
            <input type="text" id="periodo" name="periodo"><br><br>

            <label for="subperiodo">Subperiod:</label>
            <input type="text" id="subperiodo" name="subperiodo"><br><br>

            <label for="descripcion">Description:</label><br>
            <textarea rows="10" cols="70" id="descripcion" name="descripcion"></textarea><br><br>

            <label for="link1">Link 1:</label>
            <textarea rows="1" cols="70" type="text" id="link1" name="link1"></textarea><br><br>

            <label for="link2">Link 2:</label>
            <textarea rows="1" cols="70" type="text" id="link2" name="link2"></textarea><br><br>

            <label for="link3">Link 3:</label>
            <textarea rows="1" cols="70" type="text" id="link3" name="link3"></textarea><br><br>

            <label for="video1">Video 1:</label>
            <textarea rows="1" cols="70" type="text" id="video1" name="video1"></textarea><br><br>

            <label for="video2">Video 2:</label>
            <textarea rows="1" cols="70" type="text" id="video2" name="video2"></textarea><br><br>

            <label for="imagen">Main Image:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>

            <label for="imagen_secundaria1">Secondary Image 1:</label>
            <input type="file" id="imagen_secundaria1" name="imagen_secundaria1" accept="image/*"><br><br>

            <label for="imagen_secundaria2">Secondary Image 2:</label>
            <input type="file" id="imagen_secundaria2" name="imagen_secundaria2" accept="image/*"><br><br>

            <label for="imagen_secundaria3">Secondary Image 3:</label>
            <input type="file" id="imagen_secundaria3" name="imagen_secundaria3" accept="image/*"><br><br>

            <button type="submit" name="save-info" id="save-info">Save</button>
            <button type="submit" name="close-info" id="close-info">Close</button><br><br>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div id="footer">
      <div id="div-stores">
        <a href="#"><img id="apple" src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"></a>
        <a href="#"><img id="android" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/2560px-Google_Play_Store_badge_EN.svg.png"></a>
        <a href="#"><img id="microsoft" src='https://developer.microsoft.com/en-us/store/badges/images/English_get-it-from-MS.png'></a>
      </div>
      <div id="container">
        <div id="copyright">Copyright &copy; 2024 <strong><span>ArchaeoTours</span></strong>. All Rights Reserved</div>
      </div>
    </div>
  </footer>
</body>
</html>