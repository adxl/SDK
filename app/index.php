<?php

if (!isset($_SESSION)) {
    session_start();
}

include 'Provider.php';
include 'providers/FacebookProvider.php';
include 'providers/GoogleProvider.php';
include 'providers/GithubProvider.php';
include 'providers/FireAuthProvider.php';

include 'SDK.php';


if (isset($_GET['p'])) {
    $state = uniqid();
    $provider = $_GET['p'] . 'Provider';

    $_SESSION['provider'] = $provider;

    $p = new $provider();
    $p->showForm($state);
}

$providers = [
    new FacebookProvider(),
    new GoogleProvider(),
    new GithubProvider(),
    new FireAuthProvider(),
];

new SDK($providers);
