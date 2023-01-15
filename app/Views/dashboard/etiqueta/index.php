<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>
<a href="/dashboard/etiqueta/new">Crear</a>

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
            Opciones
        </th>
    </tr>
    <?php foreach ($etiquetas as $key => $p) : ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->titulo ?></td>
            <td><?= $p->categoria ?></td>
            <td>
                <a href="/dashboard/etiqueta/show/<?= $p->id ?>">Show</a>
                <a href="/dashboard/etiqueta/edit/<?= $p->id ?>">Edit</a>

                <form action="/dashboard/etiqueta/delete/<?= $p->id ?>" method="post">
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
    <?php endforeach ?>

</table>
<?= $this->endSection() ?>