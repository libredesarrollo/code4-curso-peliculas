<?= $this->extend('Layouts/blog') ?>

<?= $this->section('contenido') ?>

<div class="card">
    <div class="card-body">
        <h1><?= $pelicula->titulo ?></h1>
        <hr>
        <a target="_blank" href="<?= route_to('blog.pelicula.index_por_categoria', $pelicula->categoria_id) ?>" class="btn btn-primary"><?= $pelicula->categoria ?></a>
        <p><?= $pelicula->descripcion ?></p>

        <h3>Imágenes</h3>

        <div class="d-flex gap-2">
            <?php foreach ($imagenes as $i) : ?>

                <img class="w-25" src="/uploads/peliculas/<?= $i->imagen ?>">

            <?php endforeach ?>
        </div>

        <h3>Etiquetas</h3>

        <?php foreach ($etiquetas as $e) : ?>
            <a target="_blank" class="btn btn-sm btn-warning" href="<?= route_to('blog.pelicula.index_por_etiqueta', $e->id) ?>"><?= $e->titulo ?></a>
        <?php endforeach ?>

    </div>
</div>

<?= $this->endSection() ?>