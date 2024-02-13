<?php
require_once 'allcontrollers.php';
require_once 'usefulfunctions.php';
require_once 'exceptions.php';
require 'hashmap.php';



// On renvoie du JSON, car c'est un API
header("Content-Type: application/json; charset=utf8");
// Autoriser le front(Et à vrai dire n'importe quel host) à utiliser cet API pour s'afficher
header("Access-Control-Allow-Origin: *");
$body = file_get_contents("php://input");
$json = json_decode($body);




// Récupérer la requête en cours de traitement et en isoler le path
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// séparer le path dans un tableau en se basant sur les '/'
$uri = explode('/', $uri);
$path = $uri[2];
$secpath = $uri[3] ?? "";
$method = $_SERVER['REQUEST_METHOD'];



if ($method === "OPTIONS") {
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Origin: *");
    header("HTTP/1.1 200 OK");
    exit();
}


if ($method === "GET") { // Si la méthode est GET, alors on récupère les paramètres de la requête, en ignorant le body
    $json = (object) $_GET;
}

// On vérifie que le path demandé est bien un path existant
if (!array_key_exists($path, $hashmap) || !array_key_exists($secpath, $hashmap[$path])) {
    // Si le chemin demandé n'existe pas, alors on renvoie le header HTTP "Not Found"
    header("HTTP/1.1 404 Not Found");
    exit();
}

if (!array_key_exists($method, $hashmap[$path][$secpath])) {
    header("HTTP/1.1 405 Method Not Allowed");
    exit();
} else {
    // Si la méthode demandée existe, alors on appelle la route correspondante
    callController($path . ucfirst($hashmap[$path][$secpath][$method]), $json);
}





