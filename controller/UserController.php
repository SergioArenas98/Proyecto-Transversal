<?php
session_start();

$user = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        $user->login();
    }
    if (isset($_POST["logout"])) {
        $user->logout();
    }
    if (isset($_POST["register-admin"])) {
        $user->registerAdmin();
    }
    if (isset($_POST["register-user"])) {
        $user->registerUser();
    }
    if (isset($_POST["read-info"])) {
        $user->read();
    }
    if (isset($_POST["save-info"])) {
        $user->updateProfile();
    }
    if (isset($_POST["delete-user"])) {
        $user->deleteUser();
    }
    if (isset($_POST["updatePlaceAjax"])) {
        $user->updateProfileAjax();
    }
    if (isset($_POST["update-info"])) {
        header("Location: ../view/updateInfoProfile.php");
    }
    if (isset($_POST["close-info"])) {
        header("Location: ../view/profile.php");
    }
}

class UserController
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
            //echo "Connected successfully";
        } catch (PDOException $e) {
            //echo "Connection failed: " . $e->getMessage();
        }
    }

    public function deleteUser(): void
    {
        $username = $_SESSION["user"];

        try {
            $stmt = $this->conn->prepare("DELETE FROM Usuario WHERE nombre=?");
            $stmt->bindParam(1, $username);
            $stmt->execute();
            $this->logout();
        } catch (PDOException $e) {
            $_SESSION["error"] = "Error deleting user: " . $e->getMessage();
            header("Location: ../view/profile.php");
            exit();
        }
    }

    public function logout(): void
    {
        unset($_SESSION["logged"]);
        unset($_SESSION["user"]);

        session_destroy();

        header("Location: ../view/mainPage.php");
    }

    public function login(): void
    {
        $stmt = $this->conn->prepare("SELECT id_usuario, nombre, contraseña, imagen, tipo_usuario FROM Usuario WHERE nombre=?");
        $stmt->bindParam(1, $_POST["name_login"]);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            if (password_verify($_POST["password_login"], $result['contraseña'])) {
                $_SESSION["logged"] = true;
                $_SESSION["id_user"] = $result["id_usuario"];
                $_SESSION["user"] = $_POST["name_login"];
                $_SESSION["pw"] = $_POST["password_login"];
                $_SESSION["imagen"] = $result['imagen'];
                $_SESSION["user_type"] = $result['tipo_usuario'];
    
                $this->conn = null;
    
                $_SESSION["message"] = "Login successful!";
                header("Location: ../view/profile.php");
                exit();
            } else {
                $_SESSION["logged"] = false;
                $_SESSION["error"] = "Invalid password.";
    
                $this->conn = null;
                header("Location: ../view/loginRegister.php");
                exit();
            }
        } else {
            $_SESSION["logged"] = false;
            $_SESSION["error"] = "Invalid username.";
    
            $this->conn = null; 
            header("Location: ../view/loginRegister.php");
            exit();
        }
    }

    public function read(): void
    {
        $username = $_SESSION["id_user"];

        $stmt = $this->conn->prepare("SELECT nombre, apellido1, apellido2, contraseña, email, tarjeta_credito, imagen, tipo_usuario FROM Usuario WHERE id_usuario=?");
        $stmt->bindParam(1, $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION["user"] = $result['nombre'];
            $_SESSION["ape1"] = $result['apellido1'];
            $_SESSION["ape2"] = $result['apellido2'];
            $_SESSION["pw"] = $result['contraseña'];
            $_SESSION["email"] = $result['email'];
            $_SESSION["tarjeta_credito"] = $result['tarjeta_credito'];
            $_SESSION["imagen"] = $result['imagen'];
            $_SESSION["user_type"] = $result['tipo_usuario'];

            $this->conn = null;

            header("Location: ../view/readInfoProfile.php");
        } else {
            $_SESSION["error_read"] = "Error. Data not found.";

            $this->conn = null;
        }
    }

    public function registerAdmin(): void
    {
        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();
    
        $nameAdmin = $_POST["name_admin"];
        $emailAdmin = $_POST["email_admin"];
        $passwordAdmin = $_POST["password_admin"];
        $userType = "Admin";
    
        // Validación del email
        if (!filter_var($emailAdmin, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "Invalid email format";
            header("Location: ../view/loginRegister.php");
            exit();
        }
    
        // Validación de la contraseña
        if (strlen($passwordAdmin) < 5 || !preg_match('/[A-Z]/', $passwordAdmin) || !preg_match('/[0-9]/', $passwordAdmin)) {
            $_SESSION["error"] = "The password does not meet the requirements: minimum 5 characters, 1 uppercase letter and 1 number.";
            header("Location: ../view/loginRegister.php");
            exit();
        }
    
        // Hash de la contraseña
        $hashed_password = password_hash($passwordAdmin, PASSWORD_DEFAULT);
    
        // Manejo de la imagen subida
        $image = $imageUploader->imgUpload('img_admin');
    
        if ($image) {
            try {
                $stmt = $this->conn->prepare("INSERT INTO Usuario (nombre, email, contraseña, imagen, tipo_usuario) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $nameAdmin);
                $stmt->bindParam(2, $emailAdmin);
                $stmt->bindParam(3, $hashed_password);
                $stmt->bindParam(4, $image);
                $stmt->bindParam(5, $userType);
    
                if ($stmt->execute()) {
                    $idUsuario = $this->conn->lastInsertId();
                    $_SESSION["message"] = "Admin registered successfully!";
                    $_SESSION["logged"] = true;
                    $_SESSION["user"] = $nameAdmin;
                    $_SESSION["pw"] = $hashed_password;
                    $_SESSION["email"] = $emailAdmin;
                    $_SESSION["imagen"] = $image;
                    $_SESSION["user_type"] = $userType;
                    $_SESSION["id_user"] = $idUsuario;
                    $stmt->closeCursor();
    
                    $this->conn = null;
    
                    header("Location: ../view/mainPage.php");
                    exit();
                } else {
                    $_SESSION["error"] = "Error registering admin. Please try again.";
                    header("Location: ../view/loginRegister.php");
                }
            } catch (PDOException $e) {
                $_SESSION["error"] = "Database error: " . $e->getMessage();
                header("Location: ../view/loginRegister.php");
            }
        } else {
            $_SESSION["error"] = "No image uploaded or error uploading image.";
            header("Location: ../view/loginRegister.php");
        }
    }
    
    
    public function registerUser(): void
    {
        $userName = $_POST["name_user"];
        $emailUser = $_POST["email_user"];
        $passwordUser = $_POST["password_user"];
        $userType = "Estandar";

        if (!filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "Invalid email format";
            header("Location: ../view/loginRegister.php");
            exit();
        }

        if (strlen($passwordUser) < 8 || !preg_match('/[A-Z]/', $passwordUser) || !preg_match('/[0-9]/', $passwordUser)) {
            $_SESSION["error"] = "The password does not meet the requirements: minimum 8 characters, 1 uppercase letter and 1 number.";
            header("Location: ../view/loginRegister.php");
            exit();
        }

        $hashed_password = password_hash($passwordUser, PASSWORD_DEFAULT);

        try {
            $stmt = $this->conn->prepare("INSERT INTO Usuario (nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $emailUser);
            $stmt->bindParam(3, $hashed_password);
            $stmt->bindParam(4, $userType);

            if ($stmt->execute()) {
                $idUsuario = $this->conn->lastInsertId();
                $_SESSION["message"] = "User registered successfully!";
                $_SESSION["logged"] = true;
                $_SESSION["user"] = $userName;
                $_SESSION["pw"] = $passwordUser;
                $_SESSION["email"] = $emailUser;
                $_SESSION["user_type"] = $userType;
                $_SESSION["id_user"] = $idUsuario;

                $stmt->closeCursor();

                $this->conn = null;

                header("Location: ../view/mainPage.php");
                exit();
            } else {
                $_SESSION["error"] = "Error registering user. Please try again.";
                header("Location: ../view/loginRegister.php");
            }
        } catch (PDOException $e) {
            $_SESSION["error"] = "Database error: " . $e->getMessage();
            header("Location: ../view/loginRegister.php");
        }
    }

    public function updateProfile(): void
    {

        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();

        $username = $_SESSION["id_user"];
        
        $stmt = $this->conn->prepare("SELECT nombre, apellido1, apellido2, contraseña, email, tarjeta_credito, imagen FROM Usuario WHERE id_usuario=?");
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($currentData) {
            if (!empty($_POST["userName"])) {
                $_SESSION['user'] = $_POST["userName"];
            } else {
                $_SESSION['user'] = $currentData['nombre'];
            }
            if (!empty($_POST["ape1"])) {
                $_SESSION['ape1'] = $_POST["ape1"];
            } else {
                $_SESSION['ape1'] = $currentData['apellido1'];
            }
            if (!empty($_POST["ape2"])) {
                $_SESSION['ape2'] = $_POST["ape2"];
            } else {
                $_SESSION['ape2'] = $currentData['apellido2'];
            }
            if (!empty($_POST["password"])) {
                $_SESSION['pw'] = password_hash($_POST["password"], PASSWORD_DEFAULT);
            } else {
                $_SESSION['pw'] = $currentData['contraseña'];
            }
            if (!empty($_POST["email"])) {
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION["error"] = "Invalid email format";
                    header("Location: ../view/loginRegister.php");
                    exit();
                } else {
                    $_SESSION['email'] = $_POST["email"];
                }
            } else {
                $_SESSION['email'] = $currentData['email'];
            }
            if (!empty($_POST["tarjeta_credito"])) {
                $_SESSION['tarjeta_credito'] = $_POST["tarjeta_credito"];
            } else {
                $_SESSION['tarjeta_credito'] = $currentData['tarjeta_credito'];
            }
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $_SESSION['imagen'] = $imageUploader->imgUpload('imagen');
            } else {
                $_SESSION['imagen'] = $currentData['imagen'];
            }
        }

        try {
            $stmt = $this->conn->prepare("UPDATE Usuario SET nombre=?, apellido1=?, apellido2=?, contraseña=?, email=?, tarjeta_credito=?, imagen=? WHERE nombre=?");
            $stmt->bindParam(1, $_SESSION['user']);
            $stmt->bindParam(2, $_SESSION['ape1']);
            $stmt->bindParam(3, $_SESSION['ape2']);
            $stmt->bindParam(4, $_SESSION['pw']);
            $stmt->bindParam(5, $_SESSION['email']);
            $stmt->bindParam(6, $_SESSION['tarjeta_credito']);
            $stmt->bindParam(7, $_SESSION['imagen']);
            $stmt->bindParam(8, $username);
            $stmt->execute();

            $_SESSION["message"] = "Profile updated successfully!";
            header("Location: ../view/profile.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION["error"] = "Error updating profile: " . $e->getMessage();
            header("Location: ../view/updateInfoProfile.php");
            exit();
        }
    }

    public function updateProfileAjax(): void {
        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();

        // Obtener los datos enviados a través de POST
        $userName = $_POST['userName'];
        $ape1 = $_POST['ape1'];
        $ape2 = $_POST['ape2'];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $tarjeta_credito = $_POST['tarjeta_credito'];

        if (isset($_POST['imagen'])) {
            $imagen = $imageUploader->imgUpload($_POST['imagen']);
        } else {
            $imagen = "";
        }

        var_dump($imagen);
        // Preparar la consulta SQL para actualizar los datos
        $stmt = $this->conn->prepare("UPDATE Usuario SET nombre=?, apellido1=?, apellido2=?, contraseña=?, email=?, tarjeta_credito=?, imagen=? WHERE id_usuario=?");
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $ape1);
        $stmt->bindParam(3, $ape2);
        $stmt->bindParam(4, $password);
        $stmt->bindParam(5, $email);
        $stmt->bindParam(6, $tarjeta_credito);
        $stmt->bindParam(7, $imagen);
        $stmt->bindParam(8, $_SESSION["id_user"]);

        // Ejecutar la consulta y verificar si se realizó alguna actualización
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Datos actualizados correctamente.']);
            $_SESSION['userName'] = $userName;
            $_SESSION['ape1'] = $ape1;
            $_SESSION['ape2'] = $ape2;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $_SESSION['tarjeta_credito'] = $tarjeta_credito;
            $_SESSION['imagen'] = $imagen;
        } else {
            echo json_encode(['success' => false, 'message' => 'No se realizaron cambios.']);
        }
    }
}