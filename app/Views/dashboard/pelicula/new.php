<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

<form action="/dashboard/pelicula/create" method="post">
    <?= view('dashboard/pelicula/_form', ['op' => 'Crear']) ?>
</form>
<?= $this->endSection() ?>