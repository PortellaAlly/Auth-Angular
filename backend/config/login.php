<?php
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