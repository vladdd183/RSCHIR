<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH, POST, DELETE, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once "../config/database.php";
include_once "../objects/articles.php";

$database = new Database();
$db = $database->getConnection();
$article = new Articles($db);

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        !empty($data->title) &&
        !empty($data->content) &&
        !empty($data->author)
        
    ) {
        $article->title = $data->title;
        $article->content = $data->content;
        $article->author = $data->author;
    
        if ($article->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Статья была записана"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно записать статью"), JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно записать статью. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $article->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Статьи не найдены."), JSON_UNESCAPED_UNICODE);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    $article->id = $_GET["id"];
    if (!empty($data->title)) {
        $article->title = $data->title;
    }
    if (!empty($data->content)) {
        $article->content = $data->content;
    }
    if (!empty($data->author)) {
        $article->author = $data->author;
    }
    if ($article->update()) {
        http_response_code(200);
    
        echo json_encode(array("message" => "Статья была обновлена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
    
        echo json_encode(array("message" => "Невозможно обновить статью"), JSON_UNESCAPED_UNICODE);
    }

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $article->id = $_GET["id"];

    if ($article->delete()) {
        http_response_code(200);
        echo json_encode(array("message" => "Статья удалена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Не удалось удалить статью"));
    }
} else {
    http_response_code(500);
    echo json_encode(array("message" => "Неопределённый запрос"), JSON_UNESCAPED_UNICODE);
}
