<?php
error_reporting(E_ALL);
setlocale(LC_ALL, "ja_JP.utf8");

/**
 * get DB connection(PDO)
 */
function getDB(){
    $db = dirname(__FILE__) . "/chat.db";
    $dsn = "sqlite:" . $db;
    $user = '';
    $pass = '';
    $dbh;
    try{
        $dbh = new PDO($dsn, $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        echo('Error:'.$e->getMessage());
        die();
    }
    return $dbh;
}

function loadSay(){
    $pdo = getDB();
    if($_REQUEST["cursor"] == "load"){
        $sql = "select * from chat where content > :cursor OR 1 = 1;";
    }else{
        $sql = "select * from chat where id > :cursor ";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":cursor" => $_REQUEST["cursor"]));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$arr = loadSay();


header("Content-Type:application/json");
echo json_encode($arr);
