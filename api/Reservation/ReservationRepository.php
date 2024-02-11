<?php

class Reservation
{

    // À NE PAS SUPPRIMER : cette fonction est utilisée pour les connexions !!
    private $connection = null;

    public function __construct()
    {
        try {
            $this->connection = pg_connect("host=database port=5432 dbname=userapi_db user=userapi password=password");
            if ($this->connection == null) {
                throw new BddConnexionException("Could not connect to database.");
            }
        } catch (BddConnexionException $e) {
            throw new BddConnexionException("Database connection failed :" . $e->getMessage(),0,$e);
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
        while ($row = pg_fetch_assoc($result)) { // NECESSAIRE POUR RECUPERER PLUSIEURS LIGNES
            $rows[] = $row;
        }

        return $rows;
    }


        public function createReservation($appart, $user, $start, $end){
            $query = 'INSERT INTO reservation (appart, user, start, end) VALUES ($1, $2, $3, $4) RETURNING (id)';
            $result = @pg_query_params($this->connection, $query, [$appart, $user, $start, $end]);
            if (!$result) {
                throw new BddBadRequestException("Query failed : " . str_replace("\"","`",substr(pg_last_error($this->connection), 8, 30000) . "...")); // Truncate the error message to 30 characters
            }
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