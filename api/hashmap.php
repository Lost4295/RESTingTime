<?php

$hashmap = [
    "connexion" => [
        "" => [
            "PUT" => "createAccount",
            "POST" => "login",
            "GET" => "getAccount",
            "PATCH" => "modifyAccountInfo",
            "DELETE" => "deleteAccount"
        ]
    ],
    "appart" => [
        "" => [
            "POST" => "create",
            "GET" => "get",
            "PATCH" => "modify",
            "DELETE" => "delete"
        ]
    ],
    "reservation" => [ // La vous mettez le $path / le préfix des fonctions du controller (soit normalement le nom du dossier)
        "" => // ici la route spécifique (exemple : /template/create donc create est la route spécifique)
        [
            "POST" => "create",      // exemple de fonction appelée dans le controller
            "GET" => "get",          // exemple de fonction appelée dans le controller
            "DELETE" => "delete",    // exemple de fonction appelée dans le controller
            "PUT" => "modify"    // exemple de fonction appelée dans le controller
        ]
    ]
];
