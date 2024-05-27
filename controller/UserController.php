<?php
session_start();

$user = new UserController();

// POST requests
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

    // Constructor to initialize the database connection
    public function __construct()
    {
        // Set database parameters
        $servername = "localhost";
        $username = "root";
        $password = "Sergio14Sejuma18";
        $dbname = "archaeotours";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        }
    }

    // Method to delete a user from the database
    public function deleteUser(): void
    {
        $username = $_SESSION["user"];

        // Set statement
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

    // Method to log out a user
    public function logout(): void
    {
        // Unset session variables
        unset($_SESSION["logged"]);
        unset($_SESSION["user"]);
        
        // Destroy the session and redirect to mainPage
        session_destroy();
        header("Location: ../view/mainPage.php");
    }

    // Method to log in a user
    public function login(): void
    {
        // Set statement
        $stmt = $this->conn->prepare("SELECT id_usuario, nombre, contraseña, imagen, tipo_usuario FROM Usuario WHERE nombre=?");
        $stmt->bindParam(1, $_POST["name_login"]);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // If statement successful, save data in session
        if ($result) {
            if (password_verify($_POST["password_login"], $result['contraseña'])) {
                $_SESSION["logged"] = true;
                $_SESSION["id_user"] = $result["id_usuario"];
                $_SESSION["user"] = $_POST["name_login"];
                $_SESSION["pw"] = $_POST["password_login"];
                $_SESSION["imagen"] = $result['imagen'];
                $_SESSION["user_type"] = $result['tipo_usuario'];
    
                $this->conn = null;
    
                // Redirect user
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
        // If statement unsuccessful, refresh page
        } else {
            $_SESSION["logged"] = false;
            $_SESSION["error"] = "Invalid username.";
    
            $this->conn = null; 
            header("Location: ../view/loginRegister.php");
            exit();
        }
    }

    // Method to read user information
    public function read(): void
    {
        $username = $_SESSION["id_user"];

        // Set statement
        $stmt = $this->conn->prepare("SELECT nombre, apellido1, apellido2, contraseña, email, tarjeta_credito, imagen, tipo_usuario FROM Usuario WHERE id_usuario=?");
        $stmt->bindParam(1, $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // If statement successful, save data in session
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
        // If statement unsuccessful, show error message
        } else {
            $_SESSION["error_read"] = "Error. Data not found.";
            $this->conn = null;
        }
    }

    // Method to register a new admin user
    public function registerAdmin(): void
    {
        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();
    
        $nameAdmin = $_POST["name_admin"];
        $emailAdmin = $_POST["email_admin"];
        $passwordAdmin = $_POST["password_admin"];
        $userType = "Admin";
    
        // Email validation
        if (!filter_var($emailAdmin, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "Invalid email format";
            header("Location: ../view/loginRegister.php");
            exit();
        }
    
        // Password validation
        if (strlen($passwordAdmin) < 5 || !preg_match('/[A-Z]/', $passwordAdmin) || !preg_match('/[0-9]/', $passwordAdmin)) {
            $_SESSION["error"] = "The password does not meet the requirements: minimum 5 characters, 1 uppercase letter and 1 number.";
            header("Location: ../view/loginRegister.php");
            exit();
        }
    
        // Hash the password
        $hashed_password = password_hash($passwordAdmin, PASSWORD_DEFAULT);
    
        // Handle the uploaded image
        $image = $imageUploader->imgUpload('img_admin');
    
        // If image uploaded successfully
        if ($image) {
            // Set statement
            try {
                $stmt = $this->conn->prepare("INSERT INTO Usuario (nombre, email, contraseña, imagen, tipo_usuario) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $nameAdmin);
                $stmt->bindParam(2, $emailAdmin);
                $stmt->bindParam(3, $hashed_password);
                $stmt->bindParam(4, $image);
                $stmt->bindParam(5, $userType);
    
                if ($stmt->execute()) {
                    // If statement successful, save data in session
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
            // Error on statement or connection
            } catch (PDOException $e) {
                $_SESSION["error"] = "Database error: " . $e->getMessage();
                header("Location: ../view/loginRegister.php");
            }
        // If image uploaded unsuccessfully
        } else {
            $_SESSION["error"] = "No image uploaded or error uploading image.";
            header("Location: ../view/loginRegister.php");
        }
    }
    
    // Method to register a new standard user
    public function registerUser(): void
    {
        $userName = $_POST["name_user"];
        $emailUser = $_POST["email_user"];
        $passwordUser = $_POST["password_user"];
        $userType = "Estandar";

        // Email validation
        if (!filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "Invalid email format";
            header("Location: ../view/loginRegister.php");
            exit();
        }

        // Password validation
        if (strlen($passwordUser) < 8 || !preg_match('/[A-Z]/', $passwordUser) || !preg_match('/[0-9]/', $passwordUser)) {
            $_SESSION["error"] = "The password does not meet the requirements: minimum 8 characters, 1 uppercase letter and 1 number.";
            header("Location: ../view/loginRegister.php");
            exit();
        }

        // Hash the password
        $hashed_password = password_hash($passwordUser, PASSWORD_DEFAULT);

        // Set statement
        try {
            $stmt = $this->conn->prepare("INSERT INTO Usuario (nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $emailUser);
            $stmt->bindParam(3, $hashed_password);
            $stmt->bindParam(4, $userType);

            // If statement successful, save data in session
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
            // If statement unsuccessful, refresh page
            } else {
                $_SESSION["error"] = "Error registering user. Please try again.";
                header("Location: ../view/loginRegister.php");
            }
        // Error on statement or connection
        } catch (PDOException $e) {
            $_SESSION["error"] = "Database error: " . $e->getMessage();
            header("Location: ../view/loginRegister.php");
        }
    }

    // Method to update a user's profile
    public function updateProfile(): void
    {
        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();
    
        $userId = $_SESSION["id_user"];
        
        // Get previous data
        $stmt = $this->conn->prepare("SELECT nombre, apellido1, apellido2, contraseña, email, tarjeta_credito, imagen FROM Usuario WHERE id_usuario=?");
        $stmt->bindParam(1, $userId);
        $stmt->execute();
        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($currentData) {
            // Get data from form or fallback to previous data
            $nombre = !empty($_POST["userName"]) ? $_POST["userName"] : $currentData['nombre'];
            $apellido1 = !empty($_POST["ape1"]) ? $_POST["ape1"] : $currentData['apellido1'];
            $apellido2 = !empty($_POST["ape2"]) ? $_POST["ape2"] : $currentData['apellido2'];
            $contraseña = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : $currentData['contraseña'];
            
            if (!empty($_POST["email"])) {
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION["error"] = "Invalid email format";
                    header("Location: ../view/updateInfoProfile.php");
                    exit();
                } else {
                    $email = $_POST["email"];
                }
            } else {
                $email = $currentData['email'];
            }
            
            $tarjeta_credito = !empty($_POST["tarjeta_credito"]) ? $_POST["tarjeta_credito"] : $currentData['tarjeta_credito'];
            $imagen = !empty($_FILES['imagen']['tmp_name']) ? $imageUploader->imgUpload('imagen') : $currentData['imagen'];
    
            // Update statement
            try {
                $stmt = $this->conn->prepare("UPDATE Usuario SET nombre=?, apellido1=?, apellido2=?, contraseña=?, email=?, tarjeta_credito=?, imagen=? WHERE id_usuario=?");
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $apellido1);
                $stmt->bindParam(3, $apellido2);
                $stmt->bindParam(4, $contraseña);
                $stmt->bindParam(5, $email);
                $stmt->bindParam(6, $tarjeta_credito);
                $stmt->bindParam(7, $imagen);
                $stmt->bindParam(8, $userId);
                $stmt->execute();
    
                $_SESSION["user"] = $nombre;
                $_SESSION["ape1"] = $apellido1;
                $_SESSION["ape2"] = $apellido2;
                $_SESSION["email"] = $email;
                $_SESSION["tarjeta_credito"] = $tarjeta_credito;
                $_SESSION["imagen"] = $imagen;
    
                $_SESSION["message"] = "Profile updated successfully!";
                header("Location: ../view/profile.php");
                exit();
            } catch (PDOException $e) {
                $_SESSION["error"] = "Error updating profile: " . $e->getMessage();
                header("Location: ../view/updateInfoProfile.php");
                exit();
            }
        }
    }    

    // Method to update a user's profile with AJAX
    public function updateProfileAjax(): void {
        require_once "../controller/utils.php";
        $imageUploader = new ImageUploader();

        // Get data sent with POST
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

        // Set statement
        $stmt = $this->conn->prepare("UPDATE Usuario SET nombre=?, apellido1=?, apellido2=?, contraseña=?, email=?, tarjeta_credito=?, imagen=? WHERE id_usuario=?");
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $ape1);
        $stmt->bindParam(3, $ape2);
        $stmt->bindParam(4, $password);
        $stmt->bindParam(5, $email);
        $stmt->bindParam(6, $tarjeta_credito);
        $stmt->bindParam(7, $imagen);
        $stmt->bindParam(8, $_SESSION["id_user"]);
        $stmt->execute();

        // If statement successful, save data in session
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Data updated successfully.']);
            $_SESSION['userName'] = $userName;
            $_SESSION['ape1'] = $ape1;
            $_SESSION['ape2'] = $ape2;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $_SESSION['tarjeta_credito'] = $tarjeta_credito;
            $_SESSION['imagen'] = $imagen;
        // If statement unsuccessful, send error message
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes were made.']);
        }
    }
}