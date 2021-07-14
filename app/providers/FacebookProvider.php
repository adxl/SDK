<?php

class FacebookProvider extends Provider implements ProviderInterface
{
    private $env;

    public function __construct()
    {
        parent::__construct(
            'Facebook',
            'facebook.png',
            'https://www.facebook.com/v2.10/dialog/oauth',
            'https://graph.facebook.com/oauth/access_token',
            'https://graph.facebook.com/me'
        );

        $this->env = Env::getFacebookEnv();
    }

    function showForm($state)
    {
        header('Location: ' . $this->authorization_url .
            '?' . http_build_query([
                'response_type' => 'code',
                'client_id' => $this->env['client_id'],
                'redirect_uri' => $this->redirect_url,
                'state' => $state
            ]));
    }

    function getToken($state, $code)
    {
        $url = $this->token_url .
            '?' . http_build_query([
                'client_id' => $this->env['client_id'],
                'client_secret' => $this->env['client_secret'],
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirect_url,
                'code' => $code
            ]);



        $result = file_get_contents($url);
        $result = json_decode($result, true);

        $access_token = $result['access_token'];

        return "Bearer $access_token";
    }

    function getUser($access_token)
    {
        $url = $this->user_url .
            '?' . http_build_query([
                'fields' => 'name, picture'
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
            'picture' => $user['picture']['data']['url']
        ];
    }
}
