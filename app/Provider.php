<?php

include "providers/Env.php";

interface ProviderInterface
{
    function showForm();
    function getToken($state, $code);
    function getUser($token);
}

class Provider
{
    public $name;
    public $logo;

    protected $authorization_url;
    protected $token_url;
    protected $user_url;
    protected $redirec_url;

    public function __construct(
        $name,
        $logo,
        $authorization_url,
        $token_url,
        $user_url,
        $redirec_url
    ) {
        $this->name = $name;
        $this->logo = $logo;
        $this->authorization_url = $authorization_url;
        $this->token_url = $token_url;
        $this->user_url = $user_url;
        $this->redirec_url = $redirec_url;
    }
}
