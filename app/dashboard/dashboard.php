<?php

class Dashboard
{
    private string $username;
    private string $picture;

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
