<?php

class ConnectionDb
{
    private $hostname = "localhost:3306";
    private $user = "root";
    private $pass = "";
    private $database = "db_api";

    private $con = null;

    public function getConnection()
    {
        try {
            $this->con = mysqli_connect(
                $this->hostname,
                $this->user,
                $this->pass,
                $this->database
            );
            return $this->con;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
