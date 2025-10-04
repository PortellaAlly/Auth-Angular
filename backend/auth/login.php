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

$stmt = $db->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
$stmt->execute([$data->email]);

if($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(password_verify($data->senha, $row['senha'])) {
        echo json_encode([
            "message" => "Login realizado",
            "id" => $row['id'],
            "nome" => $row['nome'],
            "email" => $row['email']
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Senha incorreta"]);
    }
} else {
    http_response_code(404);
    echo json_encode(["message" => "Usuário não encontrado"]);
}
?>