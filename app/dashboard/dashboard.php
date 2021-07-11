<?php

class Dashboard
{
    private $username;
    private $picture;

    public function __construct($username, $picture)
    {
        $this->username = $username;
        $this->picture = $picture;
    }

    public function __destruct()
    {
        $username = $this->username;
        $picture = $this->picture;
        include "dashboard/view.php";
    }
}
