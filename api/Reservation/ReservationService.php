<?php

require_once 'ReservationRepository.php';

//Ici toutes vos fonctions et vos tests + les appels aux fonctions du repository

function crenr($json)
{
    if (is_object($json) && $json->start && $json->end && $json->appart && $json->user) {
        $start = $json->start;
        $end = $json->end;
        $appart = $json->appart;
        $user = $json->user;
        $conn = new Reservation();
        $conn->createReservation($appart, $user, $start, $end);
    } else { 
        throw new MissingParameterException('Missing parameter !');
    }
}

function getenr($json)
{
    if (is_object($json) && $json->id) {
    $id = $json->id;
    }
    $conn = new Reservation();
    return $conn->getReservation($id ?? null);
}

function delenr($json)
{
    if (is_object($json) && $json->id) {
        $id = $json->id;
        $conn = new Reservation();
        $conn->deleteReservation($id);
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}

function modenr($json)
{
    if (is_object($json) && $json->id && ( $json->start || $json->end || $json->appart)) {
        $id = $json->id;
        $start = $json->start;
        $end = $json->end;
        $appart = $json->appart;
        $user = $json->user;
        $conn = new Reservation();
        $conn->modifyReservation($id, $appart, $user, $start, $end);
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}
