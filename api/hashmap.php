<?php


$hashmap = [
    "connexion" => [
        "register" => ["POST" => "createAccount"],
        "login" => ["POST" => "login"],
        // ""=>["GET" => "getAccount"],
        // ""=>["DELETE" => "deleteAccount"],
        // ""=>["PUT" => "modifyAccountInfo"]
    ],
    // "template" => [ // La vous mettez le $path / le préfix des fonctions du controller (soit normalement le nom du dossier)
    // ""=> // ici la route spécifique (exemple : /template/create donc create est la route spécifique)
    //     [
    //          "POST" => "createTemplate",      // exemple de fonction appelée dans le controller
    //          "GET" => "getTemplate",          // exemple de fonction appelée dans le controller
    //          "DELETE" => "deleteTemplate",    // exemple de fonction appelée dans le controller
    //          "PUT" => "modifyTemplateInfo"    // exemple de fonction appelée dans le controller
    //     ]
    // ]
];
