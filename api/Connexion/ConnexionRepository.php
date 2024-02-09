<?php

class Connexion
{

    private $connection = null;

    public function __construct()
    {
        try {
            $this->connection = pg_connect("host=database port=5432 dbname=userapi_db user=userapi password=password");
            if ($this->connection == null) {
                throw new Exception("Could not connect to database.", 500);
            }
        } catch (Exception $e) {
            throw new Exception("Database connection failed :" . $e->getMessage(), 500);
        }
    }


    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $result = @pg_query($this->connection, $query);
        if (!$result) {
            throw new Exception("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "..."), 500); // Truncate the error message to 30 characters
        }

        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function getAllUsersConn()
    {
        $query = "SELECT username, password FROM users";
        $result = @pg_query($this->connection, $query);
        if (!$result) {
            throw new Exception("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "..."), 500); // Truncate the error message to 30 characters
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
            throw new Exception("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "..."), 500); // Truncate the error message to 30 characters
        }
        return pg_fetch_assoc($result);
    }

    public function createUser($first_Name, $last_Name, $email, $username, $password)
    {
        $query = 'INSERT INTO users (first_name, last_name, email, username, password) VALUES ($1, $2, $3, $4, $5) RETURNING (id)';
        $result = @pg_query_params($this->connection, $query, [$first_Name, $last_Name, $email,  $username, $password]);
        if (!$result) {
            throw new Exception("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 30) . "..."), 500); // Truncate the error message to 30 characters
        }
        return pg_fetch_assoc($result);
    }

    public function removeUser($id)
    {
        $query = "DELETE FROM users WHERE email = $1";
        $result = @pg_query_params($this->connection, $query, [$id]);
        if (!$result) {
            throw new Exception("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 3000) . "..."), 500); // Truncate the error message to 30 characters

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
                throw new Exception("Query failed : " . str_replace("\"", "`", substr(pg_last_error($this->connection), 8, 3000) . "..."), 500); // Truncate the error message to 30 characters
            }
            return pg_fetch_assoc($result);
        } else {
            throw new Exception("Missing mandatory parameters");
        }
    }
}
