<?php

function read_file($filename)
{
    if (!file_exists($filename)) {
        throw new InvalidArgumentException("{$filename} not found");
    }
    $data = file($filename);
    return array_map(fn ($item) => unserialize($item), $data);
}

function write_file($data, $filename)
{
    if (!file_exists($filename)) {
        throw new InvalidArgumentException("{$filename} not found");
    }
    $data = array_map(fn ($item) => serialize($item), $data);
    return file_put_contents($filename, implode(PHP_EOL, $data));
}

function findInDb($criteria, $filename, $multiple = false)
{
    $apps = read_file($filename);
    $results = array_values(
        array_filter(
            $apps,
            fn ($item) => count(array_intersect_assoc($item, $criteria)) === count($criteria)
        )
    );

    return !count($results) ? null : ($multiple ? $results : $results[0]);
}

function findApp($criteria)
{
    return findInDb($criteria, './data/app.data');
}

function findCode($criteria)
{
    return findInDb($criteria, './data/code.data');
}

function findToken($criteria)
{
    return findInDb($criteria, './data/token.data');
}

function findAllCode($criteria)
{
    return findInDb($criteria, './data/code.data', true);
}

function findUser($criteria)
{
    return ['user_id' => uniqid()];
}

function register()
{
    ["name" => $name, "redirect_uri" => $redirect_uri] = $_POST;


    if (findApp(["name" => $name]) !== null) throw new InvalidArgumentException("{$name} already registered");

    $clientID = uniqid();
    $clientSecret = sha1($clientID);

    $apps = read_file('./data/app.data');
    $apps[] = ['name' => $name,  "client_id" => $clientID, "client_secret" => $clientSecret, "redirect_uri" => $redirect_uri];

    write_file($apps, "./data/app.data");
    http_response_code(201);
    echo json_encode(["client_id" => $clientID, "client_secret" => $clientSecret]);
}

function auth()
{
    ["client_id" => $clientID, "state" => $state, "scope" => $scope] = $_GET;
    if (null === ($app = findApp(["client_id" => $clientID]))) die("{$clientID} not exists");
    if (wasAppAuthorized($clientID)) return handleAuth(true);

    $app_name = $app['name'];

    $success_uri = "/success?state={$state}&client_id={$clientID}";
    $cancel_uri = "https://localhost";

    include('./view.php');
}

function wasAppAuthorized($clientID)
{
    return findAllCode(['client_id' => $clientID]) !== null;
}

function handleAuth()
{
    ["state" => $state, "client_id" => $clientID] = $_GET;

    if (null === ($app = findApp(["client_id" => $clientID]))) throw new RuntimeException("{$clientID} not exists");

    $queryParams = ["state" => $state];
    $code = uniqid();
    $queryParams["code"] = $code;
    $codes = read_file("./data/code.data");
    $codes[] = [
        "code" => $code,
        "expires_in" => (new DateTimeImmutable())->modify("+5 minutes"),
        "client_id" => $clientID,
        "user_id" => uniqid()
    ];
    write_file($codes, "./data/code.data");

    $redirectUrl = $app["redirect_uri"];
    $redirectUrl .= "?" . http_build_query($queryParams);
    header("Location: {$redirectUrl}");
}

function handleAuthCode()
{
    ['code' => $code, "client_id" => $clientID] = $_GET;
    if (null === ($codeEntity = findCode(["client_id" => $clientID, "code" => $code]))) throw new RuntimeException("{$code} not exists");
    if ($codeEntity['expires_in'] < (new DateTimeImmutable())) throw new RuntimeException("Code {$code} has expired");
    return $codeEntity['user_id'];
}


function token()
{
    ["client_id" => $clientID, "client_secret" => $clientSecret] = $_GET;
    if (null === findApp(["client_id" => $clientID, "client_secret" => $clientSecret])) throw new RuntimeException("{$clientID} not exists");

    $userId = handleAuthCode();

    $expiresIn = (new DateTimeImmutable())->modify("+1 month");
    $token = [
        'token' => uniqid(),
        'expires_in' => $expiresIn,
        'user_id' => $userId,
        'client_id' => $clientID
    ];
    $tokens = read_file("./data/token.data");
    $tokens[] = $token;
    write_file($tokens, "./data/token.data");

    http_response_code(200);
    echo json_encode([
        'access_token' => $token['token'],
        'expires_in' => $expiresIn->getTimestamp() - (new DateTimeImmutable())->getTimestamp()
    ]);
}

function me()
{
    $authHeader = getallheaders()['Authorization'] ?? '';
    if (!str_starts_with($authHeader, 'Bearer ')) throw new RuntimeException("Not authorized");

    $token = preg_replace('/Bearer +/', '', $authHeader);

    if (null === ($tokenEntity = findToken(['token' => $token]))) throw new RuntimeException("Not authorized");
    if ($tokenEntity['expires_in'] < (new DateTimeImmutable())) throw new RuntimeException("Token {$token} has expired");

    // Get User
    echo json_encode([
        'name' => $tokenEntity['user_id']
    ]);
}

$route = strtok($_SERVER["REQUEST_URI"], "?");
switch ($route) {
    case '/register':
        register();
        break;
    case '/auth':
        auth();
        break;
    case '/success':
        handleAuth();
        break;
    case '/token':
        token();
        break;
    case '/me':
        me();
        break;
    default:
        http_response_code(404);
        break;
}
