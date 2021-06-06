<?php

header("Access-Control-Allow-Origin: *");

$resp = array();
$resp["sucesso"] = true;
$resp["mensagem"] = "";

$host = "localhost:3306";
$user = "root";
$pass = "";
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
        // Obter quadros existentes
        $sql_query = "SELECT id ,name  FROM boards;";
        if (($sql_query_result = $connection->query($sql_query))) {
            $boards = array();
            while ($board = $sql_query_result->fetch_assoc()) {
                array_push($boards, $board);
            }
            $resp["boards"] = $boards;
        }
        break;
    case 'createBoard':
        // Criação do quadro
        $boardName = $_POST["board_name"];
        $sql_query = "INSERT INTO boards VALUES (null, '$boardName')";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    case 'getLists':
        //Obter Lista(s) do quadro, caso existam
        $boardId = $_GET["board_id"];
        $sql_query_lists = "SELECT id, name FROM lists where fk_board_id = $boardId";
        if (($sql_query_lists_result = $connection->query($sql_query_lists))) {
            $lists = array();
            while ($list = $sql_query_lists_result->fetch_assoc()) {
                //Obtendo cartões da Lista caso existam
                $sql_query_cards = "SELECT id, description FROM cards where fk_list_id = $list[id]";
                if (($sql_query_cards_result = $connection->query($sql_query_cards))) {
                    $cards = array();
                    while ($card = $sql_query_cards_result->fetch_assoc()) {
                        array_push($cards, $card);
                    }
                    $list["cards"] = $cards;
                }
                array_push($lists, $list);
            }
            $resp["lists"] = $lists;
        }

        break;
    case 'createList':
        // Criando Lista
        $listName = $_POST["list_name"];
        $boardId = $_POST["board_id"];
        $sql_query = "INSERT INTO lists VALUES (null, '$listName',$boardId)";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    case 'updateList':
        // Criando Lista
        $listId = $_POST["list_id"];
        $listName = $_POST["list_name"];
        $sql_query = "UPDATE lists SET name = '$listName' WHERE lists.id = $listId";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    case 'deleteList':
        // Criando Lista
        $listId = $_GET["list_id"];
        $sql_query = "DELETE FROM lists WHERE id = $listId;";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    case 'createCard':
        // Criando Lista
        $cardDescription = $_POST["card_description"];
        $listId = $_POST["list_id"];
        $sql_query = "INSERT INTO cards VALUES (null, '$cardDescription',$listId)";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    case 'updateCard':
        // Criando Lista
        $cardId = $_POST["card_id"];
        $cardDescription = $_POST["card_description"];
        $sql_query = "UPDATE cards SET description = '$cardDescription' WHERE id = $cardId";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    case 'deleteCard':
        // Criando Lista
        $cardId = $_GET["card_id"];
        $sql_query = "DELETE FROM cards WHERE id = $cardId;";
        if (!($connection->query($sql_query))) {
            $resp["sucesso"] = false;
            $resp["mensagem"] = $connection->error . $sql_query;
        }
        break;
    default:
        $resp["sucesso"] = false;
        $resp["mensagem"] = "Erro: Opção invalida";
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
