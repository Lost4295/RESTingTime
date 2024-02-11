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
        // ""=>["DELETE" => "deleteAccount"],
        // ""=>["PUT" => "modifyAccountInfo"]
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
    ""=> // ici la route spécifique (exemple : /template/create donc create est la route spécifique)
        [
             "POST" => "notImplemented",      // exemple de fonction appelée dans le controller
             "GET" => "notImplemented",          // exemple de fonction appelée dans le controller
             "DELETE" => "notImplemented",    // exemple de fonction appelée dans le controller
             "PUT" => "notImplemented"    // exemple de fonction appelée dans le controller
        ]
    ]
];
