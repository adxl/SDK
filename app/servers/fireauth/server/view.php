<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OAuth</title>
    <link rel="shortcut icon" type="image/png" href="assets/fo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <main class="container h-100 d-flex justify-content-center align-items-center">
        <div class="card text-center">
            <div class="card-body">
                <div class="mb-5">
                    <div class="d-flex justify-content-center align-items-center mb-5">
                        <img width="80" src="./assets/anonymous_avatar.png">
                        <h3 class="text-muted mx-3 mb-0">x</h3>
                        <img width="80" src="./assets/fireauth.png">
                    </div>
                    <h5 class="card-title"><?= $app_name ?></h5>
                    <p>Veut accéder à votre compte via FireAuth</p>
                </div>
                <div class="d-flex justify-content-around" style="height: 50px;">
                    <a href="<?= $success_uri ?>">Autoriser</a>
                    <a href="<?= $cancel_uri ?>" class='text-danger'>Annuler</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>