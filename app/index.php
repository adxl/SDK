<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OAuth</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Login with OAUTH</h1>
        <div id="actions">
            <a href="http://localhost:8081/auth
                        ?response_type=code
                        &client_id=CLIENT_ID
                        &scope=basic
                        &state=STATE">
                AuthESGI
            </a>
            <a href="https://www.facebook.com/v2.10/dialog/oauth
                        ?response_type=code
                        &client_id=CLIENT_FBID
                        &scope=email
                        &state=STATE
                        &redirect_uri=https://localhost/fbauth-success">
                Facebook
            </a>
            <a>Google</a>
            <a>Github</a>
        </div>
    </main>
</body>

</html>