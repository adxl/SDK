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
                    <h5 class="card-title">Connectez-vous</h5>
                    <p class="card-text">Pour accéder à votre compte</p>
                </div>

                <div class="d-flex justify-content-around" style="height: 50px;">
                    <?php foreach ($providers as $p) : ?>
                        <a href="<?= '/?p=' . $p->getName(); ?>" title="<?= $p->getName(); ?>">
                            <img class="h-100" src="<?= "assets/" . $p->getLogo(); ?>">
                        </a>
                    <?php endforeach ?>
                </div>

            </div>
            <div class="card-footer text-muted">
                2021 &copy Adel Senhadji & Maxime Marchand - ESGI
            </div>
        </div>

    </main>
</body>

</html>