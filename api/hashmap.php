<?php


$hashmap =[
    "connexion" => [
        "POST" => "createAccount",
        "GET" => "getAccount",
        "DELETE" => "deleteAccount",
        "PUT" => "modifyAccountInfo"
    ],
    // "template" => [ // La vous mettez le $path / le préfix des fonctions du controller (soit normalement le nom du dossier)
    //     "POST" => "createTemplate",      // exemple de fonction appelée dans le controller
    //     "GET" => "getTemplate",          // exemple de fonction appelée dans le controller
    //     "DELETE" => "deleteTemplate",    // exemple de fonction appelée dans le controller
    //     "PUT" => "modifyTemplateInfo"    // exemple de fonction appelée dans le controller
    // ]
];