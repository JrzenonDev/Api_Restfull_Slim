<?php
error_reporting(0);
require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost", "root", "", "udemy_middleware_slim");

// Routes
$app->get("/produtos", function() use($db, $app){

    $query = $db->query("SELECT * FROM produtos;");

    $produtos = array();

    while($fila=$query->fetch_assoc()) {
        $produtos[] = $fila;
    }

    echo json_encode($produtos);

});

$app->run();