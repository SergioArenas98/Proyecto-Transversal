<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="readInfoProfile.css">
  <title>Read Information Profile</title>
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
    <div id="div-img-profile">
      <div class="logo">
      <?php if (isset($_SESSION['user']) && $_SESSION['user_type'] === 'Admin') : ?>
          <img id="img-profile" src="<?php echo $_SESSION["imagen"]; ?>">
        <?php elseif (!isset($_SESSION['user']) && $_SESSION['user_type'] === 'Admin') : ?>
          <p>Image not found</p>
        <?php endif; ?>
      </div>
    </div>
    <div id="div-info1"></div>
    <div id="div-info2">
      <h2 id="title-info">Read Profile information</h2>
      <div id="profileFormRead">
        <form id="read_profile" action="../controller/UserController.php" method="post">
          <p><strong>Username: </strong><?php echo isset($_SESSION["user"]) ? $_SESSION["user"] : '<em>Not found</em>'; ?></p><br>
          <p><strong>First surname: </strong><?php echo isset($_SESSION["ape1"]) ? $_SESSION["ape1"] : '<em>Not found</em>'; ?></p><br>
          <p><strong>Second surname: </strong><?php echo isset($_SESSION["ape2"]) ? $_SESSION["ape2"] : '<em>Not found</em>'; ?></p><br>
          <p><strong>Password: </strong>************</p><br>
          <p><strong>Email: </strong><?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : '<em>Not found</em>'; ?></p><br>
          <p><strong>Credit card number: </strong><?php echo isset($_SESSION["tarjeta_credito"]) ? $_SESSION["tarjeta_credito"] : '<em>Not found</em>'; ?></p><br>
          <p><strong>User type: </strong><?php echo isset($_SESSION["user_type"]) ? $_SESSION["user_type"] : '<em>Not found</em>'; ?></p><br>
          <button type="submit" name="close-info" id="close-info">Close</button>
        </form>
      </div>
    </div>
    <div id="div-info3"></div>
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