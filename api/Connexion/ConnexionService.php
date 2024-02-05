<?php

require_once 'ConnexionRepository.php';


function ccr($json)
{
    if (is_object($json)) {
        $username = $json->username;
        $email = $json->email;
        $password = $json->password;
        $firstName = $json->nom;
        $lastName = $json->prenom;
        $conn = new Connexion();
        $conn->createUser($firstName, $lastName, $email, $username, $password);
    } else {
        return new Exception('Missing parameter !', 400);
    }
}
// inputFirstName
// inputLastName
// inputEmail
// inputPassword
// inputPasswordConfirm