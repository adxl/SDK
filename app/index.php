<?php

session_start();

include 'dashboard/dashboard.php';

include 'Provider.php';
include 'providers/FacebookProvider.php';
// include 'providers/GoogleProvider.php';
include 'providers/GithubProvider.php';
// include 'providers/FireAuthProvider.php';

include 'SDK.php';


if (isset($_GET['p'])) {
    $state = uniqid();
    $code = $_SESSION['code'] ?? NULL;

    $provider = $_GET['p'] . 'Provider';
    $p = new $provider();

    if (!isset($code)) {
        $p->showForm($state);
        return;
    }

    unset($_SESSION['code']);

    $token = $p->getToken($state, $code);
    if (!isset($token)) {
        die('token error');
    }

    $user = $p->getUser($token);
    if (!isset($user)) {
        die('user not found');
    }

    new Dashboard($user['name'], $user['picture']);

    session_unset();
}


$providers = [
    new FacebookProvider(),
    // new GoogleProvider(),
    new GithubProvider(),
    // new FireAuthProvider(),
];

new SDK($providers);
