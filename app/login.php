<?php

include 'Provider.php';
include 'providers/FacebookProvider.php';
include 'providers/GoogleProvider.php';
include 'providers/GithubProvider.php';
include 'providers/FireAuthProvider.php';

include 'dashboard/dashboard.php';

if (empty($_GET)) {
    die("ERROR");
}

if (!isset($_SESSION)) {
    session_start();
}

$code = $_GET['code'];
$state = $_GET['state'];

$provider = $_SESSION['provider'];
unset($_SESSION['provider']);

$p = new $provider();

$token = $p->getToken($state, $code);
$user = $p->getUser($token);
if (is_null($user)) {
    die('user not found');
}

new Dashboard($user['name'], $user['picture']);
