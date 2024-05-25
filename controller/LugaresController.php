<?php
session_start();

$user = new LugaresController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["delete-place"])) {
        $user->deletePlace();
    }
    if (isset($_POST["read-info"])) {
        $user->readPlace();
    }
    if (isset($_POST["save-info"])) {
        $user->createPlace();
    }
    if (isset($_POST["update-info"])) {
        $user->updatePlace();
    }
    if (isset($_POST["updatePlaceAjax"])) {
        $user->updatePlaceAjax();
    }
    if (isset($_POST["add-place"])) {
        header("Location: ../view/addPlace.php");
    }
    if (isset($_POST["close-info"])) {
        header("Location: ../view/mainPage.php");
    }
}

class LugaresController
{
    public $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "Sergio14Sejuma18";
        $dbname = "archaeotours";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function readAllPlaces(int $page = 1, int $resultsPerPage = 5): void
    {
        $offset = ($page - 1) * $resultsPerPage;

        // Count total number of records
        $countStmt = $this->conn->prepare("SELECT COUNT(*) as total FROM Lugar");
        $countStmt->execute();
        $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Fetch records with LIMIT and OFFSET
        $stmt = $this->conn->prepare("SELECT * FROM Lugar LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $resultsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            $_SESSION["error_read"] = "Error. No places found.";
        } else {
            $_SESSION["places"] = $results;
            $_SESSION["total_pages"] = ceil($totalRecords / $resultsPerPage);
            $_SESSION["current_page"] = $page;
        }
    }

    public function readPlace(): void
    {
        $placeName = $_POST["read-info"];

        $stmt = $this->conn->prepare("SELECT localizacion, tipologia, periodo, subperiodo, descripcion, imagen, link1, link2, link3, 
        imagen_secundaria1, imagen_secundaria2, imagen_secundaria3, video1, video2 FROM Lugar WHERE nombre=?");
        $stmt->bindParam(1, $placeName);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION["name"] = $placeName;
            $_SESSION["localizacion"] = $result['localizacion'];
            $_SESSION["tipologia"] = $result['tipologia'];
            $_SESSION["periodo"] = $result['periodo'];
            $_SESSION["subperiodo"] = $result['subperiodo'];
            $_SESSION["descripcion"] = $result['descripcion'];
            $_SESSION["imagen"] = $result['imagen'];
            $_SESSION["link1"] = $result['link1'];
            $_SESSION["link2"] = $result['link2'];
            $_SESSION["link3"] = $result['link3'];
            $_SESSION["imagen_secundaria1"] = $result['imagen_secundaria1'];
            $_SESSION["imagen_secundaria2"] = $result['imagen_secundaria2'];
            $_SESSION["imagen_secundaria3"] = $result['imagen_secundaria3'];
            $_SESSION["video1"] = $result['video1'];
            $_SESSION["video2"] = $result['video2'];

            $this->conn = null;

            header("Location: ../view/informationPage.php");
        } else {
            $_SESSION["error_read"] = "Error. Place not found.";

            $this->conn = null;
        }
    }

    public function createPlace(): void
    {

        $nombre = $_POST["nombre"];
        $localizacion = $_POST["localizacion"];
        $tipologia = $_POST["tipologia"];
        $periodo = $_POST["periodo"];
        $subperiodo = $_POST["subperiodo"];
        $descripcion = $_POST["descripcion"];
        $link1 = $_POST["link1"];
        $link2 = $_POST["link2"];
        $link3 = $_POST["link3"];
        $video1 = $_POST["video1"];
        $video2 = $_POST["video2"];
        $imagen_secundaria1 = $_POST["imagen_secundaria1"];
        $imagen_secundaria2 = $_POST["imagen_secundaria2"];
        $imagen_secundaria3 = $_POST["imagen_secundaria3"];

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen'];
            $uploadDirectory = "../view/img/";
            $imgFileName = uniqid() . '_' . $imagen['name'];
            $imgFilePath = $uploadDirectory . $imgFileName;
            move_uploaded_file($imagen['tmp_name'], $imgFilePath);
        } else {
            $_SESSION["error"] = "No image uploaded or error uploading image.";
        }
        if (isset($_FILES['imagen_secundaria1']) && $_FILES['imagen_secundaria1']['error'] === UPLOAD_ERR_OK) {
            $imagen_secundaria1 = $_FILES['imagen_secundaria1'];
            $uploadDirectory = "../view/img/";
            $imgFileNameSec1 = uniqid() . '_' . $imagen_secundaria1['name'];
            $imgFilePathSec1 = $uploadDirectory . $imgFileNameSec1;
            move_uploaded_file($imagen_secundaria1['tmp_name'], $imgFilePathSec1);
        } else {
            $_SESSION["error"] = "No image uploaded or error uploading image.";
        }
        if (isset($_FILES['imagen_secundaria2']) && $_FILES['imagen_secundaria2']['error'] === UPLOAD_ERR_OK) {
            $imagen_secundaria2 = $_FILES['imagen_secundaria2'];
            $uploadDirectory = "../view/img/";
            $imgFileNameSec2 = uniqid() . '_' . $imagen_secundaria2['name'];
            $imgFilePathSec2 = $uploadDirectory . $imgFileNameSec2;
            move_uploaded_file($imagen_secundaria2['tmp_name'], $imgFilePathSec2);
        } else {
            $_SESSION["error"] = "No image uploaded or error uploading image.";
        }
        if (isset($_FILES['imagen_secundaria3']) && $_FILES['imagen_secundaria3']['error'] === UPLOAD_ERR_OK) {
            $imagen_secundaria3 = $_FILES['imagen_secundaria3'];
            $uploadDirectory = "../view/img/";
            $imgFileNameSec3 = uniqid() . '_' . $imagen_secundaria3['name'];
            $imgFilePathSec3 = $uploadDirectory . $imgFileNameSec3;
            move_uploaded_file($imagen_secundaria3['tmp_name'], $imgFilePathSec3);
        } else {
            $_SESSION["error"] = "No image uploaded or error uploading image.";
        }
        try {
            $stmt = $this->conn->prepare("INSERT INTO Lugar (nombre, localizacion, tipologia, periodo, subperiodo, descripcion, imagen, link1, link2, link3, 
                    imagen_secundaria1, imagen_secundaria2, imagen_secundaria3, video1, video2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $localizacion);
            $stmt->bindParam(3, $tipologia);
            $stmt->bindParam(4, $periodo);
            $stmt->bindParam(5, $subperiodo);
            $stmt->bindParam(6, $descripcion);
            $stmt->bindParam(7, $imgFilePath);
            $stmt->bindParam(8, $link1);
            $stmt->bindParam(9, $link2);
            $stmt->bindParam(10, $link3);
            $stmt->bindParam(11, $imgFilePathSec1);
            $stmt->bindParam(12, $imgFilePathSec2);
            $stmt->bindParam(13, $imgFilePathSec3);
            $stmt->bindParam(14, $video1);
            $stmt->bindParam(15, $video2);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION["message"] = "Place created successfully!";
                $_SESSION["nombre"] = $nombre;
                $_SESSION["localizacion"] = $localizacion;
                $_SESSION["tipologia"] = $tipologia;
                $_SESSION["periodo"] = $periodo;
                $_SESSION["subperiodo"] = $subperiodo;
                $_SESSION["descripcion"] = $descripcion;
                $_SESSION["imagen"] = $imgFilePath;
                $_SESSION['link1'] = $link1;
                $_SESSION['link2'] = $link2;
                $_SESSION['link3'] = $link3;
                $_SESSION['imagen_secundaria1'] = $imgFilePathSec1;
                $_SESSION['imagen_secundaria2'] = $imgFilePathSec2;
                $_SESSION['imagen_secundaria3'] = $imgFilePathSec3;
                $_SESSION['video1'] = $video1;
                $_SESSION['video2'] = $video2;

                $stmt->closeCursor();

                $this->conn = null;

                header("Location: ../view/mainPage.php");
                exit();
            } else {
                $_SESSION["error"] = "Error creating place. Please try again.";
            }
        } catch (PDOException $e) {
            $_SESSION["error"] = "Database error: " . $e->getMessage();
        }

        header("Location: ../view/createPlace.php");
        exit();
    }

    public function deletePlace(): void
    {
        $placeName = $_POST["delete-place"];

        try {
            $stmt = $this->conn->prepare("DELETE FROM Lugar WHERE nombre=?");
            $stmt->bindParam(1, $placeName);
            $stmt->execute();
            $_SESSION["message"] = "Place deleted successfully!";
            header("Location: ../view/mainPage.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION["error"] = "Error deleting user: " . $e->getMessage();
            header("Location: ../view/mainPage.php");
            exit();
        }
    }
    public function updatePlace(): void
    {
        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();

        $placeName = $_SESSION["name"];

        $stmt = $this->conn->prepare("SELECT nombre, localizacion, tipologia, periodo, subperiodo, descripcion, imagen, link1, link2, link3, 
        imagen_secundaria1, imagen_secundaria2, imagen_secundaria3, video1, video2 FROM Lugar WHERE nombre=?");
        $stmt->bindParam(1, $placeName);
        $stmt->execute();
        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($currentData) {
            if (!empty($_POST["name"])) {
                $_SESSION['nombre'] = $_POST["name"];
            } else {
                $_SESSION['nombre'] = $currentData['nombre'];
            }
            if (!empty($_POST["localizacion"])) {
                $_SESSION['localizacion'] = $_POST["localizacion"];
            } else {
                $_SESSION['localizacion'] = $currentData['localizacion'];
            }
            if (!empty($_POST["tipologia"])) {
                $_SESSION['tipologia'] = $_POST["tipologia"];
            } else {
                $_SESSION['tipologia'] = $currentData['tipologia'];
            }
            if (!empty($_POST["periodo"])) {
                $_SESSION['periodo'] = $_POST["periodo"];
            } else {
                $_SESSION['periodo'] = $currentData['periodo'];
            }
            if (!empty($_POST["subperiodo"])) {
                $_SESSION['subperiodo'] = $_POST["subperiodo"];
            } else {
                $_SESSION['subperiodo'] = $currentData['subperiodo'];
            }
            if (!empty($_POST["descripcion"])) {
                $_SESSION['descripcion'] = $_POST["descripcion"];
            } else {
                $_SESSION['descripcion'] = $currentData['descripcion'];
            }
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $_SESSION['imagen'] = $imageUploader->imgUpload('imagen');
            } else {
                $_SESSION['imagen'] = $currentData['imagen'];
            }
            if (!empty($_POST["link1"])) {
                $_SESSION['link1'] = $_POST["link1"];
            } else {
                $_SESSION['link1'] = $currentData['link1'];
            }
            if (!empty($_POST["link2"])) {
                $_SESSION['link2'] = $_POST["link2"];
            } else {
                $_SESSION['link2'] = $currentData['link2'];
            }
            if (!empty($_POST["link3"])) {
                $_SESSION['link3'] = $_POST["link3"];
            } else {
                $_SESSION['link3'] = $currentData['link3'];
            }
            if (!empty($_FILES['imagen_secundaria1']['tmp_name'])) {
                $_SESSION['imagen_secundaria1'] = $imageUploader->imgUpload('imagen_secundaria1');
            } else {
                $_SESSION['imagen_secundaria1'] = $currentData['imagen_secundaria1'];
            }
            if (!empty($_FILES['imagen_secundaria2']['tmp_name'])) {
                $_SESSION['imagen_secundaria1'] = $imageUploader->imgUpload('imagen_secundaria2');
            } else {
                $_SESSION['imagen_secundaria2'] = $currentData['imagen_secundaria2'];
            }
            if (!empty($_FILES['imagen_secundaria3']['tmp_name'])) {
                $_SESSION['imagen_secundaria1'] = $imageUploader->imgUpload('imagen_secundaria3');
            } else {
                $_SESSION['imagen_secundaria3'] = $currentData['imagen_secundaria3'];
            }
            if (!empty($_POST["video1"])) {
                $_SESSION['video1'] = $_POST["video1"];
            } else {
                $_SESSION['video1'] = $currentData['video1'];
            }
            if (!empty($_POST["video2"])) {
                $_SESSION['video2'] = $_POST["video2"];
            } else {
                $_SESSION['video2'] = $currentData['video2'];
            }
        }

        try {
            $stmt = $this->conn->prepare("UPDATE Lugar SET nombre=?, localizacion=?, tipologia=?, periodo=?, subperiodo=?, descripcion=?, imagen=?, 
        link1=?, link2=?, link3=?, imagen_secundaria1=?, imagen_secundaria2=?, imagen_secundaria3=?, video1=?, video2=? WHERE nombre=?");
            $stmt->bindParam(1, $_SESSION['nombre']);
            $stmt->bindParam(2, $_SESSION['localizacion']);
            $stmt->bindParam(3, $_SESSION['tipologia']);
            $stmt->bindParam(4, $_SESSION['periodo']);
            $stmt->bindParam(5, $_SESSION['subperiodo']);
            $stmt->bindParam(6, $_SESSION['descripcion']);
            $stmt->bindParam(7, $_SESSION['imagen']);
            $stmt->bindParam(8, $_SESSION['link1']);
            $stmt->bindParam(9, $_SESSION['link2']);
            $stmt->bindParam(10, $_SESSION['link3']);
            $stmt->bindParam(11, $_SESSION['imagen_secundaria1']);
            $stmt->bindParam(12, $_SESSION['imagen_secundaria2']);
            $stmt->bindParam(13, $_SESSION['imagen_secundaria3']);
            $stmt->bindParam(14, $_SESSION['video1']);
            $stmt->bindParam(15, $_SESSION['video2']);
            $stmt->bindParam(16, $placeName);
            $stmt->execute();

            $_SESSION["message"] = "Place updated successfully!";
            header("Location: ../view/mainPage.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION["error"] = "Error updating place: " . $e->getMessage();
            header("Location: ../view/updateInfoPlace.php");
            exit();
        }
    }

    public function updatePlaceAjax(): void
    {
        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();

        // Obtener los datos enviados a través de POST
        $nombre = $_POST['nombre'];
        $localizacion = $_POST['localizacion'];
        $tipologia = $_POST['tipologia'];
        $periodo = $_POST['periodo'];
        $subperiodo = $_POST['subperiodo'];
        $descripcion = $_POST['descripcion'];
        $link1 = $_POST['link1'];
        $link2 = $_POST['link2'];
        $link3 = $_POST['link3'];
        $video1 = $_POST['video1'];
        $video2 = $_POST['video2'];
        $imagen = $imageUploader->imgUpload('imagen');
        $imagen_secundaria1 = $imageUploader->imgUpload('imagen_secundaria1');
        $imagen_secundaria2 = $imageUploader->imgUpload('imagen_secundaria2');
        $imagen_secundaria3 = $imageUploader->imgUpload('imagen_secundaria3');

        // Preparar la consulta SQL para actualizar los datos
        $stmt = $this->conn->prepare("UPDATE Lugar SET nombre = ?, localizacion = ?, tipologia = ?, periodo = ?, subperiodo = ?, descripcion = ?, link1 = ?, 
                link2 = ?, link3 = ?, video1 = ?, video2 = ?, imagen = ?, imagen_secundaria1 = ?, imagen_secundaria2 = ?, imagen_secundaria3 = ? WHERE nombre = ?");
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $localizacion);
        $stmt->bindParam(3, $tipologia);
        $stmt->bindParam(4, $periodo);
        $stmt->bindParam(5, $subperiodo);
        $stmt->bindParam(6, $descripcion);
        $stmt->bindParam(7, $link1);
        $stmt->bindParam(8, $link2);
        $stmt->bindParam(9, $link3);
        $stmt->bindParam(10, $video1);
        $stmt->bindParam(11, $video2);
        $stmt->bindParam(12, $imagen);
        $stmt->bindParam(13, $imagen_secundaria1);
        $stmt->bindParam(14, $imagen_secundaria2);
        $stmt->bindParam(15, $imagen_secundaria3);
        $stmt->bindParam(16, $_SESSION['name']);
    
        // Ejecutar la consulta y verificar si se realizó alguna actualización
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Datos actualizados correctamente.']);
            $_SESSION['nombre'] = $nombre;
            $_SESSION['localizacion'] = $localizacion;
            $_SESSION['tipologia'] = $tipologia;
            $_SESSION['periodo'] = $periodo;
            $_SESSION['subperiodo'] = $subperiodo;
            $_SESSION['descripcion'] = $descripcion;
            $_SESSION['link1'] = $link1;
            $_SESSION['link2'] = $link2;
            $_SESSION['link3'] = $link3;
            $_SESSION['video1'] = $video1;
            $_SESSION['video2'] = $video2;
            $_SESSION['imagen'] = $imagen;
            $_SESSION['imagen_secundaria1'] = $imagen_secundaria1;
            $_SESSION['imagen_secundaria2'] = $imagen_secundaria2;
            $_SESSION['imagen_secundaria3'] = $imagen_secundaria3;
        } else {
            echo json_encode(['success' => false, 'message' => 'No se realizaron cambios.']);
        }
    }
}