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
    <?= view('partials/_session') ?>
    <?= $this->renderSection('contenido') ?>
</body>

</html>