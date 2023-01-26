<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>
<a class="btn btn-success btn-lg mb-4" href="/dashboard/pelicula/new">Crear</a>

<table class="table">

    <tr>
        <th>
            Id
        </th>
        <th>
            Título
        </th>
        <th>
            Categoría
        </th>
        <th>
            Descripcion
        </th>
        <th>
            Opciones
        </th>
    </tr>
    <?php foreach ($peliculas as $key => $p) : ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->titulo ?></td>
            <td><?= $p->categoria ?></td>
            <td><?= $p->descripcion ?></td>
            <td>
                <a href="/dashboard/pelicula/show/<?= $p->id ?>" class="btn btn-secondary btn-sm mt-1">Show</a>
                <a href="/dashboard/pelicula/edit/<?= $p->id ?>" class="btn btn-primary btn-sm mt-1">Edit</a>
                <a class="btn btn-primary btn-sm mt-1" href="<?= route_to('pelicula.etiquetas', $p->id) ?>">Tags</a>

                <form action="/dashboard/pelicula/delete/<?= $p->id ?>" method="post">
                    <button type="submit" class="btn btn-danger btn-sm mt-1">Delete</button>
                </form>

            </td>
        </tr>
    <?php endforeach ?>
</table>

<?= $pager->links() ?>
<?= $this->endSection() ?>