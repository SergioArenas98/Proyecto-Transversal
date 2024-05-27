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
  <link rel="stylesheet" href="updateInfoProfile.css">
  <script src="../view/jquery-3.7.1.min.js"></script>
  <script src="../view/updateInfoProfile.js" defer></script>
  <title>Update Information Profile</title>
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
    <div id="div-info2">
      <h2 id="title-info">Update Profile information</h2>
      <div id="profileFormUpdate">
        <form id="read_profile" action="../controller/UserController.php" method="post" enctype="multipart/form-data">

          <p><strong>Username: </strong><?php echo isset($_SESSION["user"]) ? $_SESSION["user"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="userName" name="userName"><br><br>

          <p><strong>First surname: </strong><?php echo isset($_SESSION["ape1"]) ? $_SESSION["ape1"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="ape1" name="ape1"><br><br>

          <p><strong>Second surname: </strong><?php echo isset($_SESSION["ape2"]) ? $_SESSION["ape2"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="ape2" name="ape2"><br><br>

          <p><strong>Password: </strong>************</p>
          <input type="text" id="password" name="password"><br><br>

          <p><strong>Email: </strong><?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : '<em>Not found</em>'; ?></p>
          <input type="email" id="email" name="email"><br><br>

          <p><strong>Credit card number: </strong><?php echo isset($_SESSION["tarjeta_credito"]) ? $_SESSION["tarjeta_credito"] : '<em>Not found</em>'; ?></p>
          <input type="text" id="tarjeta_credito" name="tarjeta_credito"><br><br>

          <?php if (isset($_SESSION['user']) && $_SESSION['user_type'] === 'Admin') : ?>
            <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>
          <?php endif; ?>

          <button type="button" name="update-profile-ajax" id="update-profile-ajax">Update Ajax</button>
          <button type="submit" name="save-info" id="save-info">Save</button>
          <button type="submit" name="close-info" id="close-info">Close</button><br><br>
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