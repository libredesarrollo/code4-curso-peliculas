<?php foreach ($peliculas as $p) : ?>
    <div class="card mb-3">
        <div class="card-body">

            <img class="w-100" src="/uploads/peliculas/<?= $p->imagen ?>">

            <h4><?= $p->titulo ?></h4>
            <a target="_blank" href="<?= route_to('blog.pelicula.index_por_categoria', $p->categoria_id) ?>" class="btn btn-secondary btn-sm"><?= $p->categoria ?></a>

            <p><?= $p->descripcion ?></p>
            <span><?= $p->etiquetas ?></span>
            <!-- <a class="btn btn-primary" href="/blog/<?= $p->id ?>">Ver...</a> -->
            <a class="btn btn-primary" href="<?= route_to('blog.pelicula.show', $p->id) ?>">Ver...</a>

        </div>
    </div>
<?php endforeach; ?>
<?= $pager->links() ?>