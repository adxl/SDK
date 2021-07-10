<?php

class GithubProvider extends Provider implements ProviderInterface
{

    private $env;

    public function __construct()
    {
        parent::__construct(
            'Github',
            'github.png',
            'https://github.com/login/oauth/authorize',
            'https://github.com/login/oauth/access_token',
            'https://api.github.com/user',
            'https://localhost/login.php'
        );

        $this->env = Env::getGithubEnv();
    }

    function getName()
    {
        die('i am github provider');
    }

    function showForm()
    {
        header('Location: ' . $this->authorization_url .
            '?' . http_build_query([
                'client_id' => $this->env['client_id'],
                'redirect_uri' => $this->redirec_url,
                'state' => $_SESSION['state']
            ]));
    }

    function getToken($state, $code)
    {
        $url = $this->token_url .
            '?' . http_build_query([
                'client_id' => $this->env['client_id'],
                'client_secret' => $this->env['client_secret'],
                'state' => $state,
                'code' => $code
            ]);

        $context = stream_context_create([
            'http' => [
                'user_agent' => 'CWestify GitHub OAuth Login',
                'header' => 'Accept: application/json'
            ]
        ]);

        $result = file_get_contents($url, false, $context);
        $result = json_decode($result, true);

        $token_type = $result['token_type'];
        $access_token = $result['access_token'];

        return "$token_type $access_token";
    }

    function getUser($access_token)
    {
        $context = stream_context_create([
            'http' => [
                'method'  => 'GET',
                'header'  => ['Accept: application/json', 'User-Agent: PHP', "Authorization: " . $access_token]
            ]
        ]);

        $result = file_get_contents($this->user_url, false, $context);
        $user = json_decode($result, true);

        return [
            'name' => $user['name'],
            'picture' => $user['avatar_url']
        ];
    }
}
