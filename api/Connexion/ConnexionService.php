<?php

require_once 'ConnexionRepository.php';


function ccr($json)
{
    if (is_object($json) && isset($json->username) && isset($json->email) && isset($json->password) && isset($json->nom) && isset($json->prenom)){
        $username = $json->username;
        $email = $json->email;
        $password = $json->password;
        $firstName = $json->nom;
        $lastName = $json->prenom;
        $conn = new Connexion();
        $conn->createUser($firstName, $lastName, $email, $username, $password);
    } else {
        throw new Exception('Missing parameter !', 400);
    }
}


function getaccs()
{
    $conn = new Connexion();
    return $conn->getAllUsers();
}

function login($json)
{
    if (is_object($json) && isset($json->email) && isset($json->password)){
        $email = $json->email;
        $password = $json->password;
        $conn = new Connexion();
        $user = $conn->getUser($email);
        if ($user['password'] == $password) {
            return $user;
        } else {
            throw new Exception('Wrong password !', 401);
        }
    } else {
        throw new Exception('Missing parameter !', 400);
    }
}