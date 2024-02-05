<?php

class Template
{

    // À NE PAS SUPPRIMER : cette fonction est utilisée pour les connexions !!
    private $connection = null;

    public function __construct()
    {
        try {
            $this->connection = pg_connect("host=database port=5432 dbname=userapi_db user=userapi password=password");
            if ($this->connection == null) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception("Database connection failed :" . $e->getMessage());
        }
    }
    // À NE PAS SUPPRIMER : cette fonction est utilisée pour les connexions !!



    // Exemple de fonction de requête
    public function getAllBlabla()
    {
        $query = "SELECT * FROM blablabla ";
        // si query avec params (ex: $query = "SELECT * FROM blablabla WHERE id = $1")
        // $result = @pg_query_params($this->connection, $query, [$username]);
        // sinon
        $result = @pg_query($this->connection, $query);
        //  le @ devant pg_query permet de ne pas afficher l'erreur de PHP si la requête échoue
        if (!$result) {
            throw new Exception("Query failed : " . str_replace("\"","`",substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
        } // exception custom, après vous en faites ce que vous voulez
        return pg_fetch_assoc($result);
    }


// à vous de jouer !
// ...
// ...
// ...
// ...
// ...
// ...

}