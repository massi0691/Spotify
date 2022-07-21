<?php

class User
{

    private $con;
    private $username;
    public function __construct($con, $username)
    {
        $this->username = $username;
        $this->con = $con;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        $query = $this->con->query("SELECT email  FROM users WHERE username ='$this->username'");
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['email'];
    }


    public function getId()
    {
        $query = $this->con->query("SELECT id  FROM users WHERE username ='$this->username'");
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }

    public function getFirstAndLastName()
    {
        $query = $this->con->query("SELECT concat(firstName, ' ', lastName) as 'name'  FROM users WHERE username ='$this->username'");
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['name'];
    }
}
