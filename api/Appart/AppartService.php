<?php

require_once 'AppartRepository.php';


function ccr2($json)
{
    if (
        is_object($json)
        && isset($json->superficie)
        && isset($json->max_pers)
        && isset($json->price)
        && isset($json->address)
        && isset($json->creator)
    ) {
        $superficie = $json->superficie;
        $max_pers = $json->max_pers;
        $price = $json->price;
        $address = $json->address;
        $creator = $json->creator;
        $conn = new Appart();
        $conn->createAppart($superficie, $max_pers, $price,$address , $creator);
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}


function getappars($json)
{
    if (is_object($json) && isset($json->id)){
        $id = $json->id;
    }
    $conn = new Appart();
    return $conn->getAppart($id ?? null);
}

function modifyAppart($json, $userId)
{
    // Récupérer les données de la requête JSON
    $superficie = $max_pers = $price = $address = $creator = "";
    if (is_object($json)) {
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
        if ($userId == $creator) {
            $conn = new Appart();
            $appart = $conn->getAppart($creator);
            if ($appart) {
                $conn->modifyAppart($superficie, $max_pers, $price, $address, $creator);
            } else {
                throw new Exception('Appart not found !', 404);
            }
        } else {
            throw new Exception('You are not authorized to modify this appart !', 403);
        }
    } else {
        throw new MissingParameterException('Missing parameter !');
    }
}


function deleteAppart($json)
{
    if (is_object($json)){
        if (isset($json->creator)) {
            $creator = $json->creator;
            $conn = new Appart();
            $conn->removeAppart($creator);
        } else {
            throw new MissingParameterException('Missing parameter !');
        }
    } else {
        throw new BadRequestException('Missing body !');
    }
}


