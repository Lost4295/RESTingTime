<?php

require_once 'Connexion/ConnexionService.php';
function handleAuth()
{
    $realm = 'Restricted area';
    header("Access-Control-Allow-Origin: *");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === "OPTIONS") {
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers:*");
        header("HTTP/1.1 200 OK");
        exit();
    }
    //user => password
    $users = array('admin' => 'mypass', 'guest' => 'guest');
    $users = getaccsps();
    format($users);
    // echo '<pre>';
    // var_dump($users);
    // echo '</pre>';

    $final = ["message" => "", "ok" => true];

    if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Digest realm="' . $realm . '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($realm) . '"');
        echo ('realm="' . $realm . '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($realm) . '"');
        die();
    }


    // analyze the PHP_AUTH_DIGEST variable
    if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']])) {
        $final["message"] = ('Wrong Credentials!');
        $final["ok"] = false;
    return json_encode($final);
    }

    // generate the valid response
    $A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
    $A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $data['uri']);
    $valid_response = md5($A1 . ':' . $data['nonce'] . ':' . $data['nc'] . ':' . $data['cnonce'] . ':' . $data['qop'] . ':' . $A2);

    if ($data['response'] != $valid_response) {
        $final["message"] = ('Wrong Credentials!');
        $final["ok"] = false;
    return json_encode($final);
    }

    // ok, valid username & password
    $final["message"] = 'logged in as: ' . $data['username'];
    $final["status"] = $users[$data['username']."-status"] ;
    $users["id"] = $users[$data['username']."-id"];

    return json_encode($final);
}

// function to parse the http auth header
function http_digest_parse($txt)
{

    // protect against missing data
    $needed_parts = array('nonce' => 1, 'nc' => 1, 'cnonce' => 1, 'qop' => 1, 'username' => 1, 'uri' => 1, 'response' => 1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}

function format(&$users)
{
    foreach ($users as  $value) {
        $users[$value['username']] = $value['password'];
        $users[$value['username']."-status"] = $value['status'];
        $users[$value['username']."-id"] = $value['id'];
    }
}


// $final = handleAuth();

// echo json_decode($final)->message;

