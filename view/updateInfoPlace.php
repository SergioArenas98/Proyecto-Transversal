<?php
session_start();
if (isset($_SESSION['error'])) {
  echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
  unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="updateInfoPlace.css">
  <script src="../view/jquery-3.7.1.min.js"></script>
  <script src="../view/updateInfoPlace.js" defer></script>
  <title>Update Information Place</title>
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
    <div id="div-images">
      <div class="logo">
        <h2>Main Image</h2>
        <?php if (isset($_SESSION['imagen']) && $_SESSION['imagen']) : ?>
          <img id="img_profile" src="<?php echo $_SESSION["imagen"]; ?>">
        <?php else : ?>
          <p style="font-size: 25px; color: red; font-style: italic;">Image not found</p>
        <?php endif; ?>
      </div>
      <div class="logo">
        <h2>Secondary Image 1</h2>
        <?php if (isset($_SESSION['imagen_secundaria1']) && $_SESSION['imagen_secundaria1']) : ?>
          <img class="secondary_images" src="<?php echo $_SESSION["imagen_secundaria1"]; ?>">
        <?php else : ?>
          <p style="font-size: 25px; color: red; font-style: italic;">Secondary Image 1 not found</p>
        <?php endif; ?>
      </div>
      <div class="logo">
        <h2>Secondary Image 2</h2>
        <?php if (isset($_SESSION['imagen_secundaria2']) && $_SESSION['imagen_secundaria2']) : ?>
          <img class="secondary_images" src="<?php echo $_SESSION["imagen_secundaria2"]; ?>">
        <?php else : ?>
          <p style="font-size: 25px; color: red; font-style: italic;">Secondary Image 2 not found</p>
        <?php endif; ?>
      </div>
      <div class="logo">
        <h2>Secondary Image 3</h2>
        <?php if (isset($_SESSION['imagen_secundaria3']) && $_SESSION['imagen_secundaria3']) : ?>
          <img class="secondary_images" src="<?php echo $_SESSION["imagen_secundaria3"]; ?>">
        <?php else : ?>
          <p style="font-size: 25px; color: red; font-style: italic;">Secondary Image 3 not found</p>
        <?php endif; ?>
      </div>
      <div class="logo">
        <h2>Video 1</h2>
        <?php if (isset($_SESSION['video1']) && $_SESSION['video1']) : ?>
          <iframe class="videos" width="560" height="315" src="<?php echo isset($_SESSION["video1"]) ? $_SESSION["video1"] : ''; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <?php else : ?>
          <p style="font-size: 25px; color: red; font-style: italic;">Video 1 not found</p>
        <?php endif; ?>
      </div>
      <div class="logo">
        <h2>Video 2</h2>
        <?php if (isset($_SESSION['video2']) && $_SESSION['video2']) : ?>
          <iframe class="videos" width="560" height="315" src="<?php echo isset($_SESSION["video2"]) ? $_SESSION["video2"] : ''; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <?php else : ?>
          <p style="font-size: 25px; color: red; font-style: italic;">Video 2 not found</p>
        <?php endif; ?>
      </div>
    </div>
    <div id="div-info2">
      <h2 id="title-info">Update Place information</h2>
      <div id="profileFormUpdate">
        <form id="read_profile" action="../controller/LugaresController.php" method="post" enctype="multipart/form-data">
          
          <p><strong>Nombre: </strong><?php echo isset($_SESSION["name"]) ? $_SESSION["name"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="name" name="name"><br><br>

          <p><strong>Location: </strong><?php echo isset($_SESSION["localizacion"]) ? $_SESSION["localizacion"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="localizacion" name="localizacion"><br><br>

          <p><strong>Typology: </strong><?php echo isset($_SESSION["tipologia"]) ? $_SESSION["tipologia"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="tipologia" name="tipologia"><br><br>

          <p><strong>Period: </strong><?php echo isset($_SESSION["periodo"]) ? $_SESSION["periodo"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="periodo" name="periodo"><br><br>

          <p><strong>Subperiod: </strong><?php echo isset($_SESSION["subperiodo"]) ? $_SESSION["subperiodo"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="subperiodo" name="subperiodo"><br><br>

          <p><strong>Description: </strong><?php echo isset($_SESSION["descripcion"]) ? $_SESSION["descripcion"] : '<em>Not found</em>'; ?></p>
          <textarea rows="10" cols="70" id="descripcion" name="descripcion"></textarea><br><br>

          <p><strong>Link 1: </strong><?php echo isset($_SESSION["link1"]) ? $_SESSION["link1"] : '<em>Not found</em>'; ?></p>
          <textarea rows="1" cols="70" id="link1" name="link1"></textarea><br><br>

          <p><strong>Link 2: </strong><?php echo isset($_SESSION["link2"]) ? $_SESSION["link2"] : '<em>Not found</em>'; ?></p>
          <textarea rows="1" cols="70" id="link2" name="link2"></textarea><br><br>

          <p><strong>Link 3: </strong><?php echo isset($_SESSION["link3"]) ? $_SESSION["link3"] : '<em>Not found</em>'; ?></p>
          <textarea rows="1" cols="70" id="link3" name="link3"></textarea><br><br>

          <p><strong>Video 1: </strong><?php echo isset($_SESSION["video1"]) ? $_SESSION["video1"] : '<em>Not found</em>'; ?></p>
          <textarea rows="1" cols="70" id="video1" name="video1"></textarea><br><br>

          <p><strong>Video 2: </strong><?php echo isset($_SESSION["video2"]) ? $_SESSION["video2"] : '<em>Not found</em>'; ?></p>
          <textarea rows="1" cols="70" id="video2" name="video2"></textarea><br><br>

          <p><strong>Main Image: </strong><?php echo isset($_SESSION["imagen"]) ? $_SESSION["imagen"] : '<em>Not found</em>'; ?></p>
          <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>

          <p><strong>Secondary Image 1: </strong><?php echo isset($_SESSION["imagen_secundaria1"]) ? $_SESSION["imagen_secundaria1"] : '<em>Not found</em>'; ?></p>
          <input type="file" id="imagen_secundaria1" name="imagen_secundaria1" accept="image/*"><br><br>

          <p><strong>Secondary Image 2: </strong><?php echo isset($_SESSION["imagen_secundaria2"]) ? $_SESSION["imagen_secundaria2"] : '<em>Not found</em>'; ?></p>
          <input type="file" id="imagen_secundaria2" name="imagen_secundaria2" accept="image/*"><br><br>

          <p><strong>Secondary Image 3: </strong><?php echo isset($_SESSION["imagen_secundaria3"]) ? $_SESSION["imagen_secundaria3"] : '<em>Not found</em>'; ?></p>
          <input type="file" id="imagen_secundaria3" name="imagen_secundaria3" accept="image/*"><br><br>

          <button type="button" name="update-info-ajax" id="update-info-ajax">Update Ajax</button>
          <button type="submit" name="update-info" id="update-info">Update</button>
          <button type="submit" name="close-info" id="close-info">Close</button>
        </form>
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