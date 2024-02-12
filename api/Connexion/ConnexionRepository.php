<?php

class Connexion
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


    public function getAllUsers($id)
    {
        $query = "SELECT * FROM users";
        if ($id) {
            $query .= " WHERE id = $1";
            $result = @pg_query_params($this->connection, $query, [$id]);
        } else {
            $result = @pg_query($this->connection, $query);
        }
        if (!$result) {
            throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
        }

        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function getAllUsersConn()
    {
        $query = "SELECT id, username, password, status FROM users";
        $result = @pg_query($this->connection, $query);
        if (!$result) {
            throw new BddConnexionException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
        }

        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function getUser($email)
    {
        $query = "SELECT * FROM users WHERE email = $1";
        $result = @pg_query_params($this->connection, $query, [$email]);
        if (!$result) {
            throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
        }
        return pg_fetch_assoc($result);
    }
    public function createUser($first_Name, $last_Name, $email, $username, $password)
    {
        $query = 'INSERT INTO users (first_name, last_name, email, username, password) VALUES ($1, $2, $3, $4, $5) RETURNING (id)';
        $result = @pg_query_params($this->connection, $query, [$first_Name, $last_Name, $email,  $username, $password]);
        if (!$result) {
            throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "...")); // Truncate the error message to 30 characters
        }
        return pg_fetch_assoc($result);
    }

    public function removeUser($id)
    {
        $query = "DELETE FROM users WHERE email = $1";
        $result = @pg_query_params($this->connection, $query, [$id]);
        if (!$result) {
            throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 3000) . "...")); // Truncate the error message to 30 characters

        }
        return pg_fetch_assoc($result);
    }

    public function modifyUser($first_name, $last_name, $username , $password , $email )
    {
        $query = "UPDATE users SET";
        $c = 1;
        $table = [];
        if (!empty($first_name)) {
            $query .= " first_name = $$c ";
            $c++;
            $table[] = $first_name;
        }
        if (!empty($last_name)) {
            if ($c > 1) {
                $query .= ", ";
            }
            $query .= " last_name = $$c ";
            $c++;
            $table[] = $last_name;
        }
        if (!empty($password)) {
            if ($c > 1) {
                $query .= ", ";
            }
            $query .= " password = $$c ";
            $c++;
            $table[] = $password;
        }
        if (!empty($username)) {
            if ($c > 1) {
                $query .= ", ";
            }
            $query .= " username = $$c ";
            $c++;
            $table[] = $username;
        }
        if (!empty($email)) {
            $query .= "WHERE email = $$c ";
            $table[] = $email;
            $result = @pg_query_params($this->connection, $query, $table);
            if (!$result) {
                throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 3000) . "...")); // Truncate the error message to 30 characters
            }
            return pg_fetch_assoc($result);
        } else {
            throw new BddMissingParameterException("Missing mandatory parameters");
        }
    }


    public function modifyStatus($user, $status){
        $query = "UPDATE users SET status = $1 WHERE id = $2";
        $result = @pg_query_params($this->connection, $query, [$status, $user]);
        if (!$result) {
            throw new BddBadRequestException("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 3000) . "...")); // Truncate the error message to 30 characters
        }
        return pg_fetch_assoc($result);
    }
}
