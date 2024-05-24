<?php
session_start();
if (isset($_SESSION['message'])) {
  echo "<p style='color: red;'>" . $_SESSION['message'] . "</p>";
  unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profile.css">
  <title>Profile</title>
  <form action="../controller/UserController.php" method="post">
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
  <div class="contenedor">
    <div class="user">
      <div class="logo">
        <?php if (isset($_SESSION['user'])) { ?>
          <?php if ($_SESSION['user_type'] === 'Admin') { ?>
            <img id="profile_img" src="<?php echo $_SESSION['imagen']; ?>">
          <?php }; ?>
          <h4 id="name_profile"><?php echo $_SESSION["user"]; ?></h4>
        <?php } else { ?>
          <p style="font-size: 25px; color: red; font-style: italic;">Username not found</p>
        <?php }; ?>
      </div>

    </div>
    
    <div class="contenedor-izquierdo">
      <div class="cardIzq">
        <h4>Profile information</h4>
        <button type="submit" id="read-info" name="read-info">Read Information</button><br><br>
        <button type="submit" id="update-info" name="update-info">Update Information</button><br><br>
        <button type="submit" id="delete-user" name="delete-user">Delete User</button><br><br>
        <button class="boton" id="logout" name="logout">Log Out</button><br><br>
      </div>

      <div class="cardIzq">
        <h4>Notification Preferences</h4>
        <div class="notification">
          <div class="check">
            <input type="checkbox" id="email" name="email">
            <label for="fname">&nbsp;Email</label>
          </div>
          <div class="check">
            <input type="checkbox" id="sms" name="sms">
            <label for="fname">&nbsp;SMS</label>
          </div>
          <div class="check">
            <input type="checkbox" checked id="mobile" name="mobile">
            <label for="fname">&nbsp;Mobile App</label>
          </div>
        </div>
      </div>
    </div>

    <div class="contenedor-derecho">

      <div class="row">
        <div id="div-search">
          <form id="search-box">
            <input type="text" placeholder="Search in your routes">
            <button type="submit"><img src="../view/img/search-icon.png" alt="" width="10px"></button>
          </form>
        </div>
      </div>

      <div class="routes">
        <div class="routes-img">
          <img class="main-routes-img" src="../view/img/ruta.jpg" alt=""></img>
        </div>
        <div class="routes-title">
          <p>Ruta por la Ciutat Vella</p>
        </div>
        <div class="routes-description">
          <p>Explora la riqueza arqueológica e histórica de la Ciutat Vella de Barcelona. Desde las ruinas romanas de Barcino hasta los 
            palacios góticos y las iglesias centenarias, esta ruta te llevará a través de los siglos de historia que han dado forma a esta vibrante ciudad.</p>
        </div>
      </div>
      <div class="routes">
        <div class="routes-img">
          <img class="main-routes-img" src="../view/img/ruta.jpg" alt=""></img>
        </div>
        <div class="routes-title">
          <p>Ruta por el Born</p>
        </div>
        <div class="routes-description">
          <p>Ruta perfecta para descubrir el encanto histórico y cultural del Born de Barcelona, recorriendo sus estrechas calles medievales, 
            visitando zonas emblemáticas como el mercado de El Born y sumergiéndote en la fascinante historia de este emblemático barrio.</p>
        </div>
      </div>
      <div class="routes">
        <div class="routes-img">
          <img class="main-routes-img" src="../view/img/ruta.jpg" alt=""></img>
        </div>
        <div class="routes-title">
          <p>Ruta Prehistórica por Barcelona</p>
        </div>
        <div class="routes-description">
          <p>Explora la Barcelona prehistórica en esta ruta única. Desde los vestigios de la antigua ciudad romana hasta los yacimientos neolíticos 
            en la montaña de Montjuïc, sumérgete en el pasado ancestral de esta vibrante ciudad mediterránea.</p>
        </div>
      </div>

      <div class="row" id="addRoute">
        <button class="boton">ADD ROUTE</button>
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