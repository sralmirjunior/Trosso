<?php

header("Access-Control-Allow-Origin: *");

$resp = array();
$resp["sucesso"] = true;
$resp["mensagem"] = "";

$host = "127.0.0.1:3307";
$user = "root";
$pass = "1234";
$db   = "trosso";

$connection = new mysqli($host, $user, $pass, $db);
if ($connection->connect_error) {
    $resp["sucesso"] = false;
    $resp["mensagem"] = "Erro ao conectar-se ao banco de dados! (" . $connection->connect_error . ")";
    echo json_encode($resp);
    exit();
}

$op = "";
if (isset($_GET["op"])) {
    $op = $_GET["op"];
}
switch ($op) {
    case 'getBoards':
        // Obtendo quadros existentes
        $sql_query = "SELECT id as board_id ,name as board_name FROM boards;";
        if (($sql_query_result = $connection->query($sql_query))) {
            $boards = array();
            while ($board = $sql_query_result->fetch_assoc()) {
                array_push($boards, $board);
            }
            $resp["boards"] = $boards;
        }
        break;
    case 'createBoard':
        // Obtendo quadros existentes
        $boardName = $_POST["board_name"];
        $sql_query = "INSERT INTO boards VALUES (null, '$boardName')";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    default:
        break;
}

if ($op == "create") {

    $data = $_POST["data"];
    $categoria = $_POST["categoria"];
    $tipo = $_POST["tipo"];
    $valor = ($tipo == "C") ? $_POST["valor"] : $_POST["valor"] * -1;

    $sql_query = "INSERT INTO lancamentos VALUES (null, '$data', '$tipo', '$categoria', $valor)";
    if (!($connection->query($sql_query))) {
        $resp["sucesso"] = false;
        $resp["mensagem"] = $connection->error . $sql_query;
    }
} else
if ($op == "update") {

    $id = $_POST["id"];
    $data = $_POST["data"];
    $categoria = $_POST["categoria"];
    $tipo = $_POST["tipo"];
    $valor = ($tipo == "C") ? $_POST["valor"] : $_POST["valor"] * -1;

    $sql_query = "UPDATE lancamentos SET data = '$data', tipo = '$tipo', categoria = '$categoria', valor = $valor WHERE id = $id";
    if (!($connection->query($sql_query))) {
        $resp["sucesso"] = false;
        $resp["mensagem"] = $connection->error . $sql_query;
    }
} else
if ($op == "delete") {

    $id = 0;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }

    $sql_query = "DELETE FROM lancamentos WHERE id = $id;";
    if (!($connection->query($sql_query))) {
        $resp["sucesso"] = false;
        $resp["mensagem"] = $connection->error;
    }
}

echo json_encode($resp);
$connection->close();
