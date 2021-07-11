<?php


class FireAuthProvider extends Provider implements ProviderInterface
{
    private $env;

    public function __construct()
    {
        parent::__construct(
            'FireAuth',
            'fireauth.png',
            'http://localhost:8081/auth',
            'http://oauth-esgi-server:8081/token',
            'http://oauth-esgi-server:8081/me'
        );

        $this->env = Env::getFireAuthEnv();
    }

    function showForm($state)
    {
        header('Location: ' . $this->authorization_url .
            '?' . http_build_query([
                'response_type' => 'code',
                'client_id' => $this->env['client_id'],
                'state' => $state,
                'scope' => 'basic'
            ]));
    }

    function getToken($state, $code)
    {
        $url = $this->token_url .
            '?' . http_build_query([
                'client_id' => $this->env['client_id'],
                'client_secret' => $this->env['client_secret'],
                'code' => $code
            ]);

        $result = file_get_contents($url);
        $result = json_decode($result, true);

        $access_token = $result['access_token'];

        return "Bearer $access_token";
    }

    function getUser($access_token)
    {
        $context = stream_context_create([
            'http' => [
                'header'  => [
                    "Authorization: $access_token"
                ]
            ]
        ]);

        $result = file_get_contents($this->user_url, false, $context);
        $user = json_decode($result, true);

        return [
            'name' => $user['name'],
            'picture' => null
        ];
    }
}
