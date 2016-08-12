<?php
require_once(dirname(__FILE__) . "/config.php");

error_reporting(E_ALL);
setlocale(LC_ALL, "ja_JP.utf8");

$name = $_REQUEST["name"];
$content = $_REQUEST["content"];
$say = array(
    array(
        "name" => $name,
        "content" => $content
    )
);

function insertSay($name,$content){
    $sql = "insert into chat(name,content) values(:name,:content);";
    $pdo = getDB();
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":name" => $name, ":content" => nl2br(htmlspecialchars($content))));
}

insertSay($name,$content);

setcookie("name",$name,time()+60*60*24*365);

header("Content-Type:application/json");
echo json_encode($say);
