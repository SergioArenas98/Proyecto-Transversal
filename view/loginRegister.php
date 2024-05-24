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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Sign In</title>
  <link rel="stylesheet" href="loginRegister.css">
  <link rel="stylesheet" href="../view/slick-1.8.1/slick/slick.css">
  <link rel="stylesheet" href="../view/slick-1.8.1/slick/slick-theme.css">
  <script src="../view/jquery-3.7.1.min.js"></script>
  <script src="../view/loginRegister.js" defer></script>
  <script src="../view/slick-1.8.1/slick/slick.min.js"></script>
  <script src="../view/jquery-validation-1.19.5/dist/additional-methods.min.js"></script>
  <script src="../view/jquery-validation-1.19.5/dist/jquery.validate.min.js"></script>
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

<?php
  if (!(isset($_SESSION['logged']) && $_SESSION['logged'])) {
?>

  <form id="form" action="../controller/UserController.php" method="post" enctype="multipart/form-data">
    <div id="main-div">
      <div id="cookies">
        <p id="text-cookies">ArqueoTours use cookies. Click on "Accept" to continue.</p>
        <div id="accept-cookies">Accept</div>
      </div>
      <div id="login">
        <h2>Login</h2>
        <input type="text" id="name_login" name="name_login" placeholder="Username">
        <input type="password" id="password_login" name="password_login" placeholder="Password"><br>
        <a id="forgot-link" href="#">Forgot your password?</a><br><br>
        <button type="submit" name="login">ENTER YOUR ACCOUNT</button>
      </div>

      <div id="register-admin">
        <h2>Register Admin</h2>
        <input type="text" id="name_admin" name="name_admin" placeholder="Admin Name">
        <input type="email" id="email_admin" name="email_admin" placeholder="Email" class="email-input"><br>
        <span class="error"></span>
        <input type="password" id="password_admin" name="password_admin" placeholder="Password">
        <br><label for="img">Upload a profile image:</label><br><br>
        <input type="file" id="img_admin" name="img_admin" accept="image/*">
        <button type="submit" name="register-admin">CREATE YOUR ACCOUNT</button>
      </div>

      <div id="register-user">
        <h2>Register User</h2>
        <input type="text" id="name_user" name="name_user" placeholder="User Name">
        <input type="email" id="email_user" name="email_user" placeholder="Email" class="email-input"><br>
        <span class="error"></span>
        <input type="password" id="password_user" name="password_user" placeholder="Password"> 
        <button type="submit" name="register-user">CREATE YOUR ACCOUNT</button>
      </div>

<?php 
  } else { echo "<div class='centered-message'><p>You are already logged!</p></div>"; } 
?>
      
      <div id="divSliderSites">
        <h3>Most visited sites in Barcelona</h3>
        <div id="sliderSites">
          <div class="sites"><br />
            <img src="../view/img/templo_augusto.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Templo de Augusto</strong></li>
              <li>Temple</li>
              <li>Ancient</li>
              <li>100 BC</li>
            </ul>
          </div>  
          <div class="sites"><br />
            <img src="../view/img/sepulcro_neolítico.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Sepulcro de Sant Gervasi - Galvany</strong></li>
              <li>Necropolis</li>
              <li>Prehistory</li>
              <li>6.000 - 5.400 BP</li>
            </ul>
          </div>     
          <div class="sites"><br />
            <img src="../view/img/acueducto-barcino.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Acueducto Romano - Plaza Vuit de Març</strong></li>
              <li>Infrastructure</li>
              <li>Ancient</li>
              <li>100 BC</li>
            </ul>
          </div>
          <div class="sites"><br />
            <img src="../view/img/palacio_mayor.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Palacio Mayor</strong></li>
              <li>Palace</li>
              <li>Medieval</li>
              <li>1359 - 1370 AC</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="divSliderPeriods">
        <h3>Most relevant periods in Barcelona</h3>
        <div id="sliderPeriods">
          <div class="periods"><br />
            <img src="../view/img/prehistoria.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Prehistory</strong></li>
              <li>2.500.000 - 5.000 BP</li>
              <li></li>
            </ul>
          </div>      
          <div class="periods"><br />
            <img src="../view/img/protohistoria.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Protohistory</strong></li>
              <li>3.000 - 1.000 BC</li>
              <li></li>
            </ul>
          </div>     
          <div class="periods"><br />
            <img src="../view/img/antigua.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Ancient</strong></li>
              <li>1.000 BC - 711 AC</li>
              <li></li>
            </ul>
          </div>   
          <div class="periods"><br />
            <img src="../view/img/medieval.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Medieval</strong></li>
              <li>711 - 1.453 AC</li>
              <li></li>
            </ul>
          </div>
          <div class="periods"><br />
            <img src="../view/img/moderna.jpg" alt="" srcset="" width="250">
            <ul>
              <li><strong>Modern</strong></li>
              <li>1.453 - 1.789 AC</li>
              <li></li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </form>
  
  <footer>
    <div id="footer">
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

</body>
</html>