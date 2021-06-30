<?php

include 'Provider.php';

include 'providers/FacebookProvider.php';
include 'providers/GoogleProvider.php';
include 'providers/GithubProvider.php';
include 'providers/FireAuthProvider.php';

include 'SDK.php';

if (isset($_GET['p'])) {
    $providerName = $_GET['p'] . 'Provider';
    $provider = new $providerName();
    die($provider->getName());
}


$providers = [
    new FacebookProvider(),
    new GoogleProvider(),
    new GithubProvider(),
    new FireAuthProvider(),
];

$sdk = new SDK($providers);
