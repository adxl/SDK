<?php

$client_id = '4286ff00bb74368139df';
$client_secret = '2465b2509785a2e29a3ef4ede9045fb174e7d736';
$url_authorize = 'https://github.com/login/oauth/authorize';
$url_token = 'https://github.com/login/oauth/access_token';
$url_user = 'https://api.github.com/user';
$redirect_uri = "https://localhost/";

function showForm()
{
    global $client_id, $url_authorize, $redirect_uri;
    $_SESSION['state'] = uniqid();
    header('Location: ' . $url_authorize . '?' . http_build_query([
        'client_id' => $client_id,
        'redirect_uri' => $redirect_uri,
        'state' => $_SESSION['state']
    ]));
}

function get_token()
{
    global $url_token, $client_id, $client_secret;

    $url = $url_token . '?' . http_build_query([
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'state' => isset($_SESSION['state']),
        'code' => isset($_GET['code'])
    ]);

    $context = stream_context_create([
        'http' => [
            'user_agent' => 'CWestify GitHub OAuth Login',
            'header' => 'Accept: application/json'
        ]
    ]);

    $result = file_get_contents($url, false, $context);
    $result = json_decode($result);

    //$result->access_token
}

function get_user($access_token)
{
    global $url_user;
    $context = stream_context_create([
        'http' => [
            'header'  => ['Accept: application/json', 'User-Agent: PHP', "Authorization: token " . $access_token],
            'method'  => 'GET'
        ]
    ]);

    $result = file_get_contents($url_user, false, $context);

    $user = json_decode($result);

    return $user;
}
