<?= $this->extend('Layouts/blog')  ?>
<?= $this->section('contenido')  ?>

<h1>Peliculas por etiqueta: <?= $etiqueta->titulo ?></h1>
<hr>

<?= view('partials/_peliculas'/*, ['peliculas' => $peliculas]*/) ?>

<?= $this->endSection()  ?>