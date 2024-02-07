<?php


$hashmap = [
    "connexion" => [
        "register" => ["POST" => "createAccount"],
        "login" => ["POST" => "login"],
        "accounts" => ["GET" => "getAllAccounts"],
        // ""=>["DELETE" => "deleteAccount"],
        // ""=>["PUT" => "modifyAccountInfo"]
    ],
    // "template" => [ // La vous mettez le $path / le préfix des fonctions du controller (soit normalement le nom du dossier)
    // "route"=> // ici la route spécifique (exemple : /template/create donc create est la route spécifique)
    //     [
    //          "POST" => "notImplemented",      // exemple de fonction appelée dans le controller
    //          "GET" => "notImplemented",          // exemple de fonction appelée dans le controller
    //          "DELETE" => "notImplemented",    // exemple de fonction appelée dans le controller
    //          "PUT" => "notImplemented"    // exemple de fonction appelée dans le controller
    //     ]
    // ]
];
