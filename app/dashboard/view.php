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
    <main class="container w-25 h-100 d-flex justify-content-center align-items-center">
        <div class="card w-100 text-center">
            <div class="card-body">
                <div class="mb-5">
                    <h5 class="card-title">Bienvenue</h5>
                    <p class="card-text"><?= $username; ?></p>
                </div>
                <img src="<?= $picture ?? './assets/avatar.png' ?>" class="rounded-circle" alt="user" style="width: 200px;">
            </div>
            <div class="card-footer text-muted">
                <a href="/">Se déconnecter</a>
            </div>
        </div>
    </main>
</body>

</html>