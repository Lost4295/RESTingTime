<?php

require_once 'ConnexionRepository.php';


function ccr($json)
{
    if (is_object($json) && isset($json->username) && isset($json->email) && isset($json->password) && isset($json->nom) && isset($json->prenom)) {
        $username = $json->username;
        $email = $json->email;
        $password = $json->password;
        $firstName = $json->nom;
        $lastName = $json->prenom;
        $conn = new Connexion();
        $conn->createUser($firstName, $lastName, $email, $username, $password);
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}

function modifyUser($json)
{
    $username = $email = $password = $firstName = $lastName = "";
    if (is_object($json)) {
        if (isset($json->username)) {
            $username = $json->username;
        }
        if (isset($json->email)) {
            $email = $json->email;
        }
        if (isset($json->password)) {
            $password = $json->password;
        }
        if (isset($json->nom)) {
            $firstName = $json->nom;
        }
        if (isset($json->prenom)) {
            $lastName = $json->prenom;
        }
        $conn = new Connexion();
        $user= $conn->getUser($email);
        if($user){
            $conn->modifyUser($firstName, $lastName, $username, $password, $email);
        } else{
            throw new NotFoundException('User not found !');
        }
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}

function deleteUser($json)
{
    if (is_object($json)){
        if (isset($json->email)) {
            $email = $json->email;
            $conn = new Connexion();
            $conn->removeUser($email);
        } else {
            throw new MissingParameterException('Missing parameter !');
        }
    }
}

function getaccs($json)
{
    if (is_object($json) && isset($json->id)){
        $id = $json->id;
    }
    $conn = new Connexion();
    return $conn->getAllUsers($id ?? null);
}

function getaccsps()
{
    $conn = new Connexion();
    return $conn->getAllUsersConn();
}

function login($json)
{
    if (is_object($json) && isset($json->email) && isset($json->password)) {
        $email = $json->email;
        $password = $json->password;
        $conn = new Connexion();
        $user = $conn->getUser($email);
        if ($user && $user['password'] == $password) {
            return $user;
        } else {
            throw new UnauthorizedException('Wrong password !');
        }
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}

