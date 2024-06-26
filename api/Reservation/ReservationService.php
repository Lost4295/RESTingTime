<?php

require_once 'ReservationRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Appart/AppartRepository.php';

//Ici toutes vos fonctions et vos tests + les appels aux fonctions du repository

function crenr($json)
{
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    if (!is_object($json)) {
        throw new BadRequestException('Missing body !');
    }
    if (!isset($json->appart)) {
        throw new MissingParameterException('Missing mandatory parameter !');
    }
    $appart = $json->appart;
    $conn = new Appart();
    $app = $conn->getAppart($appart);
    if (!$app) {
        throw new NotFoundException('Appartement not found !');
    }
    if ($app[0]['available'] == 'f') {
        throw new ForbiddenException('Appartement not available !');
    }

    if (!isset($json->start) || !isset($json->end) || !isset($json->user)) {
        throw new MissingParameterException('Missing mandatory parameter !');
    }
    $start = date($json->start);
    $end = date($json->end);
    $appart = $json->appart;
    $user = $json->user;
    $conn = new Reservation();
    $enr = $conn->createReservation($start, $end, $user, $appart, $app[0]['price']);
    $conn2 = new Appart();
    $conn2->changeAppartAvailability($appart);
    $conn3 = new Connexion();
    $actUser = $conn3->getUsers($user);
    $status = testStatus($actUser[0]["status"]);
    if (!$status["locataire"]) {
        $conn3->modifyStatus($user, $actUser[0]["status"] + 2);
    }
    return $enr;
}

function getenr($json)
{
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    $userId = $final->id;
    if (!is_object($json)) {
        throw new BadRequestException('Missing body !');
    }
    $id = null;
    if (isset($json->id)) {
        $id = $json->id;
    }
    $conn1 = new Connexion();
    $user = $conn1->getUsers($userId);
    if (!$user) {
        throw new NotFoundException('User not found !');
    }
    $status = testStatus($user[0]["status"]);
    $conn = new Reservation();
    if (!$status["admin"] && !isset($id)) {
        $res = $conn->getUserReservations($userId);
    } else {
        $res = $conn->getReservation($id);
    }

    if (isset($id) && !$status["admin"] && $res[0]['user_id'] != $userId) {
        throw new NotFoundException('There is no reservation with that id !'); // FIXME Ou unauthorized ? 
    }

    return $res;
}

function delenr($json)
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
    $conn = new Reservation();
    $res = $conn->getReservation($id);
    $conn3 = new Connexion();
    $actUser = $conn3->getUsers($userId);
    $status = testStatus($actUser[0]["status"]);
    if (!$status["admin"] && $res[0]['user_id'] != $userId) {
        throw new UnauthorizedException('You are not allowed to delete this reservation !');
    }
    $conn->deleteReservation($id);
    $res = $conn->getUserReservations($userId);
    if (count($res) === 0) {
        $conn1 = new Connexion();
        if (!$actUser) {
            throw new NotFoundException('User not found !');
        }
        $status = testStatus($actUser["status"]);
        if ($status["locataire"]) {
            $conn1->modifyStatus($userId, $actUser["status"] - 2);
        }
    }
}

function modenr($json)
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
    $appart = $user = $start = $end = null;
    if (isset($json->start)) {
        $start = $json->start;
    }
    if (isset($json->end)) {
        $end = $json->end;
    }
    if (isset($json->appart)) {
        $appart = $json->appart;
    }
    if (isset($json->user)) {
        $user = $json->user;
    }
    $conn = new Reservation();
    $res = $conn->getReservation($id);
    $conn3 = new Connexion();
    $actUser = $conn3->getUsers($userId);
    $status = testStatus($actUser[0]["status"]);
    if (!$status["admin"] && $res[0]['user_id'] != $userId) {
        throw new UnauthorizedException('You are not allowed to modify this reservation !');
    }
    $conn->modifyReservation($id, $appart, $user, $start, $end);
}
