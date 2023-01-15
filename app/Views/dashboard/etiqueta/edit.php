<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

<?= view('partials/_form-error') ?>

<form action="/dashboard/etiqueta/update/<?= $etiqueta->id ?>" method="post">
    <?= view('dashboard/etiqueta/_form', ['op' => 'Actualizar']) ?>
</form>

<?= $this->endSection() ?>