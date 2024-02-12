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
    if (is_object($json) && $json->appart) {
        $appart = $json->appart;
        $conn = new Appart();
        $app = $conn->getAppart($appart);
        if (!$app) {
            throw new NotFoundException('Appartement not found !');
        }
        if ($app[0]['available'] == 'f') {
            throw new ForbiddenException('Appartement not available !');
        }
    } else {
        throw new MissingParameterException('Missing mandatory parameter !');
    }
    if ($json->start && $json->end  && $json->user) {
        $start = date($json->start);
        $end = date($json->end);
        $appart = $json->appart;
        $user = $json->user;
        $conn = new Reservation();
        $enr = $conn->createReservation($start, $end, $user, $appart, $app[0]['price']);
        $conn2 = new Appart();
        $conn2->changeAppartAvailability($appart);
        $conn3 = new Connexion();
        $actUser = $conn3->getAllUsers($user);
        $status = testStatus($actUser[0]["status"]);
        if (!$status["locataire"]) {
            $conn3->modifyStatus($user, $actUser[0]["status"] + 2);
        }
        return $enr;
    } else {
        throw new MissingParameterException('Missing mandatory parameter !');
    }
}

function getenr($json)
{
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    if (is_object($json) && $json->id) {
        $id = $json->id;
    }
    $conn = new Reservation();
    return $conn->getReservation($id ?? null);
}

function delenr($json)
{
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    $userId = $final->id;
    if (is_object($json) && $json->id) {
        $id = $json->id;
        $conn = new Reservation();
        $res = $conn->getReservation($id);
        if ($res[0]['user_id'] != $userId) {
            throw new UnauthorizedException('You are not allowed to delete this reservation !');
        }
        $conn->deleteReservation($id);
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}

function modenr($json)
{
    $final = json_decode(handleAuth());
    if (!$final->ok) {
        throw new UnauthorizedException($final->message);
    }
    $userId = $final->id;
    if (is_object($json) && $json->id) {
        $id = $json->id;
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
        if ($res[0]['user'] != $userId) {
            throw new UnauthorizedException('You are not allowed to modify this reservation !');
        }
        $conn->modifyReservation($id, $appart, $user, $start, $end);
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}



