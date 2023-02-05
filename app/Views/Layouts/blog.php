<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo web</title>

    <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg mb-3">
        <div class="container-fluid">
            <a class="navbar-brand">Code4</a>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Películas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= view('partials/_session') ?>

    <div class="container">
        <?= $this->renderSection('contenido') ?>
    </div>
</body>

</html>