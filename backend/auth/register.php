<?php
// CORS - SEMPRE NO TOPO
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Responde ao preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$senha_hash = password_hash($data->senha, PASSWORD_DEFAULT);

if($stmt->execute([$data->nome, $data->email, $senha_hash])) {
    echo json_encode(["message" => "Usuário registrado com sucesso"]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Erro ao registrar"]);
}
?>