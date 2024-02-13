<?php

$hashmap = [
    "connexion" => [
        "" => [
            "PUT" => "CreateAccount",
            "POST" => "Login",
            "GET" => "GetAccount",
            "PATCH" => "ModifyAccountInfo",
            "DELETE" => "DeleteAccount"
        ],
        "getroles" => [
            "GET" => "Getroles"
        ]
    ],
    "appart" => [
        "" => [
            "POST" => "Create",
            "GET" => "Get",
            "PATCH" => "Modify",
            "DELETE" => "Delete"
        ],
        "disponibility" => [
            "PATCH" => "Disponibility"
        ]
    ],
    "reservation" => [ // La vous mettez le $path / le préfix des fonctions du controller (soit normalement le nom du dossier)
        "" => // ici la route spécifique (exemple : /template/create donc create est la route spécifique)
        [
            "POST" => "Create",      // exemple de fonction appelée dans le controller
            "GET" => "Get",          // exemple de fonction appelée dans le controller
            "DELETE" => "Delete",    // exemple de fonction appelée dans le controller
            "PATCH" => "Modify"    // exemple de fonction appelée dans le controller
        ]
    ],


];
