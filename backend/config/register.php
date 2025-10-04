<?php
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