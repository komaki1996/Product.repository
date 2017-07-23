<?php
header("Content-Type: application/json; charset=UTF-8");
header("X-Content-Type-Option: nosniff");
$PDO = new PDO('mysql:dbname=hoge', 'hoge', 'hoge');
switch($_SERVER['REQUEST_METHOD']){
  case 'GET':
    $st = $PDO->query("SELECT * FROM inquery");
    echo json_encode($st->fetchAll(PDO::FETCH_ASSOC));
    break;
  case 'POST':
    $in = json_decode(file_get_contents('php://input'), true);
    $st = $PDO->prepare("INSERT INTO inquery(title,body) VALUES(:title,:body)");
    $st->execute(array(':title' => $in['title'], ':body' => $in['body']));
    break;
  case 'DELETE':
    $st = $PDO->prepare("DELETE FROM inquery WHERE id=?");
    $st->execute([$_GET['id']]);
    break;
}