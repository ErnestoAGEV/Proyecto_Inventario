<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
$password = hash('sha256', $data['password']); // Encripta la contraseña antes de comparar

$stmt = $pdo->prepare("SELECT id, role FROM users WHERE email = ? AND password = ?");
$stmt->execute([$email, $password]);
$user = $stmt->fetch();

if ($user) {
    $token = bin2hex(random_bytes(16)); // Genera un token aleatorio
    echo json_encode(['success' => true, 'token' => $token, 'role' => $user['role']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
}
?>
