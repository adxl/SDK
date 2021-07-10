<?php

session_start();

if (empty($_GET)) {
    die("ERROR");
}

$_SESSION['code'] = $_GET['code'];

header('/');
