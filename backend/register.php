<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
$password = hash('sha256', $data['password']); // Encripta la contraseña
$role = $data['role']; // Puede ser 'empleado' o 'supervisor'

$stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
if ($stmt->execute([$email, $password, $role])) {
    echo json_encode(['success' => true, 'message' => 'Usuario registrado']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error en el registro']);
}
?>
