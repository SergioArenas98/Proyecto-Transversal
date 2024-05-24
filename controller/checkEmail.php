<?php

$servername = "localhost";
$username = "root";
$password = "Sergio14Sejuma18";
$dbname = "archaeotours";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit();
}

header('Content-Type: application/json');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM Usuario WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        // Verificamos si el correo electrónico existe y devolvemos el resultado
        if ($count > 0) {
            echo json_encode(['exists' => true]);
        } else {
            echo json_encode(['exists' => false]);
        }
        exit();
    } catch (PDOException $e) {
        // En caso de error, devolvemos un mensaje de error como JSON con código de estado 500 (Internal Server Error)
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        exit();
    }
} else {
    // Si no se proporciona el email, devolvemos un mensaje de error como JSON con código de estado 400 (Bad Request)
    http_response_code(400);
    echo json_encode(['error' => 'Email not provided']);
    exit();
}