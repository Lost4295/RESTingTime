<?php

require_once 'AppartRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Connexion/ConnexionRepository.php';


function ccr2($json)
{
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    if (!is_object($json)) {
        throw new BadRequestException('Missing body !');
    }
    if (
        !isset($json->superficie) ||
        !isset($json->max_pers) ||
        !isset($json->price) ||
        !isset($json->address) ||
        !isset($json->creator)
    ) {
        throw new MissingParameterException('Missing parameter !');
    }
    $superficie = $json->superficie;
    $max_pers = $json->max_pers;
    $price = $json->price;
    $address = $json->address;
    $creator = $json->creator;
    $conn1 = new Connexion();
    $user = $conn1->getUsers($creator)[0];
    if (!$user) {
        throw new NotFoundException('User not found !');
    }
    $status = testStatus($user["status"]);
    if (!$status["propriétaire"]) {
        $conn1->modifyStatus($creator, $user["status"] + 4);
    }
    $conn = new Appart();
    return $conn->createAppart($superficie, $max_pers, $price, $address, $creator);
}


function getappars($json)
{
    if (is_object($json) && isset($json->id)) {
        $id = $json->id;
    }
    $conn = new Appart();
    return $conn->getAppart($id ?? null);
}

function modifyAppart($json)
{
    // Récupérer les données de la requête JSON
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    $userId = $final->id;
    if (!is_object($json)) {
        throw new BadRequestException('Missing parameter !');
    }
    if (!isset($json->id)) {
        throw new MissingParameterException('Missing parameter !');
    }
    $id = $json->id;
    $superficie = $max_pers = $price = $address = $creator = "";
    if (isset($json->superficie)) {
        $superficie = $json->superficie;
    }
    if (isset($json->max_pers)) {
        $max_pers = $json->max_pers;
    }
    if (isset($json->price)) {
        $price = $json->price;
    }
    if (isset($json->address)) {
        $address = $json->address;
    }
    if (isset($json->creator)) {
        $creator = $json->creator;
    }

    // Vérifier si l'utilisateur est le créateur de l'appartement
    if ($userId !== $creator) {
        throw new ForbiddenException('You are not authorized to modify this appart !');
    }
    $conn = new Appart();
    $appart = $conn->getAppart($id)[0];
    if (!$appart) {
        throw new NotFoundException('Appart not found !');
    }
    $conn->modifyAppart($id, $superficie, $max_pers, $price, $address, $creator);
}

function modifyAppartDisponibility($json)
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
    $conn = new Appart();
    $appart = $conn->getAppart($id)[0];
    if (!$appart) {
        throw new NotFoundException('Appart not found !');
    }
    if ($appart['creator'] !== $userId) {
        throw new ForbiddenException('You are not authorized to modify this appart !');
    }
    $conn->changeAppartAvailability($id);
    return $conn->getAppart($id)[0]['available'];
}
function deleteAppart($json)
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
    $conn = new Appart();
    $appart = $conn->getAppart($id)[0];
    if (!$appart) {
        throw new NotFoundException('Appart not found !');
    }
    if ($appart['creator'] !== $userId) {
        throw new ForbiddenException('You are not authorized to delete this appart !');
    }
    $conn->removeAppart($id);

    $conn->getUserApparts($userId);

    if (count($conn->getUserApparts($userId)) === 0) {
        $conn1 = new Connexion();
        $user = $conn1->getUsers($userId)[0];
        if (!$user) {
            throw new NotFoundException('User not found !');
        }
        $status = testStatus($user["status"]);
        if ($status["propriétaire"]) {
            $conn1->modifyStatus($userId, $user["status"] - 4);
        }
    }
}
