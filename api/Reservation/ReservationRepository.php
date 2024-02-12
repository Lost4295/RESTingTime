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


        public function createReservation($start, $end, $user, $appart, $price){
            $query = 'INSERT INTO reservation (start_date, end_date, user_id, appartement_id, price, create_date) VALUES ($1, $2, $3, $4, $5, NOW()) RETURNING (id)';
            $result = @pg_query_params($this->connection, $query, [$start, $end, $user, $appart, $price]);
            if (!$result) {
                throw new BddBadRequestException("Query failed : " . str_replace("\"","`",substr(pg_last_error($this->connection), 8, 30000) . "...")); // Truncate the error message to 30 characters
            }
            return pg_fetch_assoc($result);
        }


        public function getReservation($id)
        {
            $query = "SELECT * FROM reservation";
            $params = false;
            if ($id) {
                $query.= " WHERE id = $1"; 
                $params = true;
            $result = @pg_query_params($this->connection, $query, [$id]);
            } else {
                $result = @pg_query($this->connection, $query);
            }
            if (!$result) {
                throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
            }

            $rows = [];
            while ($row = pg_fetch_assoc($result)) {
                $rows[] = $row;
            }

            if (empty($rows) && $params) {
                throw new BddNotFoundException("No reservation found");
            }
    
            return $rows;
        }


        public function modifyReservation($id, $appart, $user, $start, $end)
        {
            $query = "UPDATE reservation SET";
            $c = 1;
            $table = [];
            if (!empty($appart)) {
                $query .= " appart = $$c ";
                $c++;
                $table[] = $appart;
            }
            if (!empty($user)) {
                if ($c > 1) {
                    $query .= ", ";
                }
                $query .= " user = $$c ";
                $c++;
                $table[] = $user;
            }
            if (!empty($start)) {
                if ($c > 1) {
                    $query .= ", ";
                }
                $query .= " start = $$c ";
                $c++;
                $table[] = $start;
            }
            if (!empty($end)) {
                if ($c > 1) {
                    $query .= ", ";
                }
                $query .= " end = $$c ";
                $c++;
                $table[] = $end;
            }
            $query .= "WHERE id = $$c";
            $table[] = $id;
            $result = @pg_query_params($this->connection, $query, $table);
            if (!$result) {
                throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
            }
            return pg_fetch_assoc($result);
        }
        public function deleteReservation($id)
        {
            $query = "DELETE FROM reservation WHERE id = $1";
            $result = @pg_query_params($this->connection, $query, [$id]);
            if (!$result) {
                throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
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