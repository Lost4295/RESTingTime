<?php

require_once 'ConnexionRepository.php';


function ccr($json)
{
    if (!is_object($json)) {
        throw new BadRequestException('Missing body !');
    }
    if (!isset($json->username) || !isset($json->email) || !isset($json->password) || !isset($json->nom) || !isset($json->prenom)) {
        throw new MissingParameterException('Missing parameter !');
    }
    $username = $json->username;
    $email = $json->email;
    $password = $json->password;
    $firstName = $json->nom;
    $lastName = $json->prenom;
    $conn = new Connexion();
    $conn->createUser($firstName, $lastName, $email, $username, $password);
}

function modifyUser($json)
{
    $username = $email = $password = $firstName = $lastName = "";
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    $userId = $final->id;
    if (!is_object($json)) {
        throw new BadRequestException('Missing body !');
    }
    if (!isset($json->id)) {
        throw new MissingParameterException('Missing parameter !');
    }
    $id = $json->id;
    if (isset($json->email)) {
        $email = $json->email;
    }
    if (isset($json->username)) {
        $username = $json->username;
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
    $user = $conn->getUsers($id)[0];
    if (!$user) {
        throw new NotFoundException('User not found !');
    }
    $status = testStatus($user["status"]);
    if ($user['id'] !== $userId && !$status['admin']) {
        throw new ForbiddenException('You can\'t modify this account !');
    }
    $conn->modifyUser($userId, $firstName, $lastName, $username, $password, $email, $status);
}

function deleteUser($json)
{
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    $userId = $final->id;
    if (!is_object($json)) {
        throw new BadRequestException('Missing body !');
    }
    if (!isset($json->id)) {
        throw new MissingParameterException('Missing parameter !');
    }
    $id = $json->id;
    $conn = new Connexion();
    $user = $conn->getUsers($id)[0];
    if (!$user) {
        throw new NotFoundException('User not found !');
    }
    $status = testStatus($user["status"]);
    if ($user['id'] !== $userId && !$status['admin']) {
        throw new ForbiddenException('You can\'t delete this account !');
    }
    $conn->removeUser($id);
}

function getaccs($json)
{
    if (is_object($json) && isset($json->id)) {
        $id = $json->id;
    }
    $conn = new Connexion();
    $users = $conn->getUsers($id ?? null);
    if (!$users && $id) {
        throw new NotFoundException('User not found !');
    }
    return $users;
}

function getaccsps()
{
    $conn = new Connexion();
    return $conn->getAllUsersConn();
}

function login($json)
{
    if (!is_object($json)) {
        throw new BadRequestException('Missing body !');
    }
    if (!isset($json->email) || !isset($json->password)) {
        throw new MissingParameterException('Missing parameter !');
    }
    $email = $json->email;
    $password = $json->password;
    $conn = new Connexion();
    $user = $conn->getUserWithEmail($email);
    if (!$user || $user['password'] != $password) {
        throw new UnauthorizedException('Wrong password !');
    }
    return $user;
}

function getroles($json){
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    $userId = $final->id;
    $conn = new Connexion();
    $user = $conn->getUsers($userId)[0];
    if (!$user) {
        throw new NotFoundException('User not found !');
    }
    $status = testStatus($user["status"]);
    if ($status['admin']) {
        $tab[]="Administrateur";
    }
    if ($status['propriétaire']) {
        $tab[]="propriétaire";
    }
    if ($status['locataire']) {
        $tab[]="locataire";
    }
    if ($status['user']) {
        $tab[]="Utilisateur";
    }
    return $tab;
}
