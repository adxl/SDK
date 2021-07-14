<?php

class GoogleProvider extends Provider implements ProviderInterface
{
    private $env;
    private $scope = 'https://www.googleapis.com/auth/userinfo.profile';

    public function __construct()
    {
        parent::__construct(
            'Google',
            'google.png',
            'https://accounts.google.com/o/oauth2/v2/auth',
            'https://oauth2.googleapis.com/token',
            'https://www.googleapis.com/oauth2/v1/userinfo'
        );

        $this->env = Env::getGoogleEnv();
    }

    function showForm($state)
    {
        header('Location: ' . $this->authorization_url .
            '?' . http_build_query([
                'response_type' => 'code',
                'client_id' => $this->env['client_id'],
                'redirect_uri' => $this->redirect_url,
                'state' => $state,
                'scope' => $this->scope,
            ]));
    }

    function getToken($state, $code)
    {
        $url = $this->token_url;

        $body = [
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => $this->env['client_id'],
            'client_secret' => $this->env['client_secret'],
            'redirect_uri' => $this->redirect_url,
        ];

        $context = stream_context_create([
            'http' => [
                'method' => "POST",
                'header'  => [
                    'Accept: application/json',
                    'Content-Type: application/x-www-form-urlencoded',
                ],
                'content' => http_build_query($body)
            ]
        ]);

        $result = file_get_contents($url, false, $context);
        $result = json_decode($result, true);

        $access_token = $result['access_token'];

        return "Bearer $access_token";
    }

    function getUser($access_token)
    {
        $url = $this->user_url .
            '?' . http_build_query([
                'alt' => 'json'
            ]);

        $context = stream_context_create([
            'http' => [
                'header'  => [
                    'Accept: application/json',
                    "Authorization: $access_token"
                ]
            ]
        ]);

        $result = file_get_contents($url, false, $context);
        $user = json_decode($result, true);

        return [
            'name' => $user['name'],
            'picture' => $user['picture']
        ];
    }
}
