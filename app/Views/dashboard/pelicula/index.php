<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>
<a href="/dashboard/pelicula/new">Crear</a>

<table>

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
                <a href="/dashboard/pelicula/show/<?= $p->id ?>">Show</a>
                <a href="/dashboard/pelicula/edit/<?= $p->id ?>">Edit</a>
                <a href="<?= route_to('pelicula.etiquetas', $p->id) ?>">Tags</a>

                <form action="/dashboard/pelicula/delete/<?= $p->id ?>" method="post">
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
    <?php endforeach ?>
</table>

<?= $pager->links() ?>
<?= $this->endSection() ?>