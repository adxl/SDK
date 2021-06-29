<?php

namespace App;

use App\Providers\Facebook\FacebookProvider;
use App\Providers\Google\GoogleProvider;
use App\Providers\Github\GithubProvider;
use App\Providers\FireAuth\FireAuthProvider;

use App\SDK;

$providers = [
    new FacebookProvider(),
    new GoogleProvider(),
    new GithubProvider(),
    new FireAuthProvider(),
];

$sdk = new SDK($providers);
