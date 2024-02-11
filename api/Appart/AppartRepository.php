<?php

class Appart
{

    private $connection = null;

    public function __construct()
    {
        try {
            $this->connection = pg_connect("host=database port=5432 dbname=userapi_db user=userapi password=password");
            if ($this->connection == null) {
                throw new BddConnexionException("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new BddConnexionException("Database connection failed :" . $e->getMessage());
        }
    }


    public function getAppart($id)
    {
        $query = "SELECT * FROM appartement";
        if ($id) {
            $query.= " WHERE id = $1"; 
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

        return $rows;
    }

    public function createAppart($superficie, $max_pers, $price, $address, $creator)
    {
        $query = 'INSERT INTO appartement (superficie, max_pers, price, address, creator) VALUES ($1, $2, $3, $4, $5) RETURNING (id)';
        $result = @pg_query_params($this->connection, $query, [$superficie, $max_pers, $price,  $address, $creator]);
        if (!$result) {
            throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30000) . "...")); // Truncate the error message to 30 characters
        }
        return pg_fetch_assoc($result);
    }

    public function removeAppart($creator)
    {
        $query = "DELETE FROM appartement WHERE creator = $1";
        $result = @pg_query_params($this->connection, $query, [$creator]);
        if (!$result) {
            throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters

        }
        return pg_fetch_assoc($result);
    }


    public function modifyAppart($superficie = "", $max_pers = "", $price = "", $address = "", $creator = "")
    {
        $query = "UPDATE appartement SET";
        $c = 1;
        $table = [];
        if (!empty($superficie)) {
            $query .= " superficie = $$c ";
            $c++;
            $table[] = $superficie;
        }
        if (!empty($max_pers)) {
            if ($c > 1) {
                $query .= ", ";
            }
            $query .= " max_pers = $$c ";
            $c++;
            $table[] = $max_pers;
        }
        if (!empty($price)) {
            if ($c > 1) {
                $query .= ", ";
            }
            $query .= " price = $$c ";
            $c++;
            $table[] = $price;
        }
        if (!empty($address)) {
            if ($c > 1) {
                $query .= ", ";
            }
            $query .= " address = $$c ";
            $c++;
            $table[] = $address;
        }
        if (!empty($creator)) {
            $query .= "WHERE id = $$c";
            $table[] = $creator;
            $result = @pg_query_params($this->connection, $query, $table);
            if (!$result) {
                throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 300) . "...")); // Truncate the error message to 30 characters
            }
            return pg_fetch_assoc($result);
        } else {
            throw new BddMissingParameterException("Missing mandatory parameters");
        }
    }
}
