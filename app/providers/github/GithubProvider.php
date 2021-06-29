<?php

namespace App\Providers\Github;

use App\Provider;

class GithubProvider extends Provider
{
    public function __construct()
    {
        parent::__construct("Github", "github.png", "/login/github", null, null);
    }
}
