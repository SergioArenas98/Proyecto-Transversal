<?php
require_once("../controller/LugaresController.php");

$user = new LugaresController();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$user->readAllPlaces($page);

if (isset($_SESSION['message'])) {
    echo "<p style='color: red;'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="mainPage.css">
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
    <div id="div-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28474.067495524938!2d2.189001257490275!3d41.396508673532814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a49816718e30e5%3A0x44b0fb3d4f47660a!2sBarcelona!5e0!3m2!1ses!2ses!4v1706868219665!5m2!1ses!2ses" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div id="div-search">
        <form id="search-box">
            <input type="text" placeholder="Find your historical places of interest">
            <button type="submit"><img src="../view/img/search-icon.png" alt=""></button>
        </form>
        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Admin') : ?>
            <form method="post" action="createPlace.php">
                <button type="submit" id="add-place" name="add-place">Add Place</button>
            </form>
        <?php endif; ?>
    </div>

    <div id="div-grid">
        <div id="box1">
            <div id="box11">
                <div id="filter-text">
                    <p>Filter by</p>
                </div>
            </div>
            <div id="box12" class="filter-box">
                <form>
                    <input type="checkbox" id="period1" name="period1" value="Palaeolithic">
                    <label for="period1">Palaeolithic</label>
                    <input type="checkbox" id="period2" name="period2" value="Prehistory">
                    <label for="period2">Prehistory</label>
                    <input type="checkbox" id="period3" name="period3" value="Protohistory">
                    <label for="period3">Protohistory</label><br><br>
                    <input type="checkbox" id="period4" name="period4" value="Ancient">
                    <label for="period4">Ancient</label>
                    <input type="checkbox" id="period5" name="period5" value="Medieval">
                    <label for="period5">Medieval</label>
                    <input type="checkbox" id="period6" name="period6" value="Modern">
                    <label for="period6">Modern</label>
                </form>
            </div>
            <div id="box13" class="filter-box">
                <form>
                    <input type="checkbox" id="period1" name="subperiod1" value="Cooper">
                    <label for="subperiod1">Cooper Age</label>
                    <input type="checkbox" id="period2" name="subperiod2" value="Bronze">
                    <label for="subperiod2">Bronze Age</label>
                    <input type="checkbox" id="period3" name="subperiod3" value="Iron">
                    <label for="subperiod3">Iron Age</label>
                </form>
            </div>
            <div id="box14" class="filter-box">
                <form>
                    <input type="checkbox" id="culture1" name="culture1" value="Tartessos">
                    <label for="culture1">Tartessos</label>
                    <input type="checkbox" id="culture2" name="culture2" value="Iberians">
                    <label for="culture2">Iberians</label>
                    <input type="checkbox" id="culture3" name="culture3" value="Celts">
                    <label for="culture3">Celts</label><br><br>
                    <input type="checkbox" id="culture4" name="culture4" value="Phoenicians">
                    <label for="culture4">Phoenicians</label>
                    <input type="checkbox" id="culture5" name="culture5" value="Carthaginians">
                    <label for="culture5">Carthaginians</label>
                    <input type="checkbox" id="culture6" name="culture6" value="Romans">
                    <label for="culture6">Romans</label>
                </form>
            </div>
            <div id="box15" class="filter-box">
                <form>
                    <input type="checkbox" id="category1" name="category1" value="Necropolis">
                    <label for="category1">Necropolis</label>
                    <input type="checkbox" id="category2" name="category2" value="Sanctuary">
                    <label for="category2">Sanctuary</label>
                    <input type="checkbox" id="category3" name="category3" value="Settlement">
                    <label for="category3">Settlement</label><br><br>
                    <input type="checkbox" id="category4" name="category4" value="Port">
                    <label for="category4">Port</label>
                    <input type="checkbox" id="category5" name="category5" value="Temple">
                    <label for="category5">Temple</label>
                    <input type="checkbox" id="category6" name="category6" value="Factory">
                    <label for="category6">Factory</label>
                </form>
            </div>
            <div id="box16" class="filter-box">
                <form>
                    <input type="checkbox" id="rating1" name="rating1" value="1star">
                    <label for="rating1">1 star</label>
                    <input type="checkbox" id="rating2" name="rating2" value="2stars">
                    <label for="rating2">2 stars</label>
                    <input type="checkbox" id="rating3" name="rating3" value="3stars">
                    <label for="rating3">3 stars</label><br><br>
                    <input type="checkbox" id="rating4" name="rating4" value="4stars">
                    <label for="rating4">4 stars</label>
                    <input type="checkbox" id="rating5" name="rating5" value="5stars">
                    <label for="rating5">5 stars</label>
                </form>
            </div>
            <div id="box17" class="filter-box">
                <form>
                    <input type="checkbox" id="culture1" name="culture1" value="Necropolis">
                    <label for="culture1">Necropolis</label>
                    <input type="checkbox" id="culture2" name="culture2" value="Sanctuary">
                    <label for="culture2">Sanctuary</label>
                    <input type="checkbox" id="culture3" name="culture3" value="Settlement">
                    <label for="culture3">Settlement</label><br><br>
                    <input type="checkbox" id="culture4" name="culture4" value="Port">
                    <label for="culture4">Port</label>
                    <input type="checkbox" id="culture5" name="culture5" value="Temple">
                    <label for="culture5">Temple</label>
                    <input type="checkbox" id="culture6" name="culture6" value="Factory">
                    <label for="culture2">Sanctuary</label><br><br>
                    <input type="checkbox" id="culture3" name="culture3" value="Settlement">
                    <label for="culture3">Palace</label>
                    <input type="checkbox" id="culture4" name="culture4" value="Port">
                    <label for="culture4">Port</label>
                    <input type="checkbox" id="culture5" name="culture5" value="Temple">
                    <label for="culture5">Temple</label><br><br>
                    <input type="checkbox" id="culture6" name="culture6" value="Factory">
                    <label for="culture6">Factory</label>
                    <input type="checkbox" id="culture6" name="culture6" value="Factory">
                    <label for="culture6">Infrastructure</label>
                </form>
            </div>
        </div>
        <div id="box2">
            <?php if (isset($_SESSION["places"]) && !empty($_SESSION["places"])) :
                foreach ($_SESSION["places"] as $place) : ?>
                    <div class="places">
                        <div class="place-img">
                            <img class="main-place-img" src="<?php echo $place['imagen']; ?>" alt=""></img>
                        </div>
                        <div class="place-title">
                            <p><?php echo $place['nombre']; ?></p>
                        </div>
                        <div class="place-description">
                            <p><?php
                                $description = $place['descripcion'];
                                $sentences = explode('.', $description);
                                echo $sentences[0] . '.'; ?></p>
                        </div>
                        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Admin') : ?>
                            <form id="form-admin" method="post">
                                <button type="submit" class="read-info-estandar" name="read-info" value="<?php echo $place['nombre']; ?>">See Place</button><br><br>
                                <button type="submit" class="delete-place" name="delete-place" value="<?php echo $place['nombre']; ?>">Delete Place</button>
                            </form>
                        <?php else : ?>
                            <form id="form-estandar" method="post">
                                <button type="submit" class="read-info-estandar" name="read-info" value="<?php echo $place['nombre']; ?>">See Place</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else :
                echo "No places found.";
            endif; ?>
            
            <?php if ($_SESSION["total_pages"] > 1) : ?>
                <div class="pagination">
                    <?php if ($_SESSION["current_page"] > 1) : ?>
                        <a href="?page=<?php echo $_SESSION["current_page"] - 1; ?>">Previous</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $_SESSION["total_pages"]; $i++) : ?>
                        <?php if ($i == $page) : ?>
                            <a href="?page=<?php echo $i; ?>" class="current"><?php echo $i; ?></a>
                        <?php else : ?>
                            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($_SESSION["current_page"] < $_SESSION["total_pages"]) : ?>
                        <a href="?page=<?php echo $_SESSION["current_page"] + 1; ?>">Next</a><br><br>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
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