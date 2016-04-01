<?php
error_reporting(0);
require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

// Routes
$app->get("/ola/:name", function($name) use ($app){
    echo "Ola ".$name."<br />";
    var_dump($app->request->params());
});

function provaMiddle() {
    echo "Sou um Middleware";
}

function provaTwo() {
    echo "Sou um Middleware 2";
}

// Routes
$app->get("/provas(/:um(/:dois))", 'provaMiddle', 'provaTwo', function($um = NULL, $dois = NULL){
    echo $um."<br />";
    echo $dois."<br />";
})->conditions(array(
    "um" => "[a-zA-Z]*",
    "dois" => "[0-9]*"
));

$uri = "/slim/index.php/api/exemplo";

$app->group("/api", function() use ($app){

    $app->group("/exemplo", function() use ($app){

        $app->get("/ola/:name", function($name){
            echo "Ola ".$name;
        })->name("ola");

        $app->get("/diga-seu-apelido/:apelido", function($apelido){
            echo "Seu apelido es ".$apelido;
        });

        $app->get("/comando-para-ola", function() use($app){
            //$app->redirect($uri."ola/Jose");
            $app->redirect($app->urlFor("ola", array(
                "name" => "Jose Roberto"
            )));
        });

    });

});

$app->run();