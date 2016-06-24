<?php 

include_once('Collection.php');

$db = new PDO("mysql:host=localhost;dbname=collection", "homestead", "secret");

$posts = $db->query("SELECT * FROM posts");
$posts = $posts->fetchAll(PDO::FETCH_OBJ);