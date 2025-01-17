<!doctype html>
<html lang="es">

<head>
    <title>Mi módulo de admin</title>
</head>

<body>
    <header>
        <h1>Módulo admin</h1>
    </header>
    <?= view("partials/_session") ?>
    <section>

        <?php if (session('usuario')) : ?>
            <p>Usuario <?= session("email") ?> con el rol de: <?= session("tipo") ?></p>
        <?php endif ?>

        <?= $this->renderSection('contenido') ?>
    </section>
    <footer>
        Footer
    </footer>
</body>

</html>