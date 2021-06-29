<?php

require "Provider.php";
require "SDK.php";

$facebookProvider = new Provider("Facebook", "facebook.png", "/login/facebook", null, null);
$googleProvider = new Provider("Google", "google.png", "/login/google", null, null);
$githubProvider = new Provider("Github", "github.png", "/login/github", null, null);
$fireAuthProvider = new Provider("FireAuth", "fireauth.png", "/login/fireauth", null, null);

$providers = [
    $facebookProvider,
    $googleProvider,
    $githubProvider,
    $fireAuthProvider
];

$sdk = new SDK($providers);
