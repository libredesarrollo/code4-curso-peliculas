<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>
<a class="btn btn-success btn-lg mb-4" href="/dashboard/etiqueta/new">Crear</a>

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
            Opciones
        </th>
    </tr>
    <?php foreach ($etiquetas as $key => $p) : ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->titulo ?></td>
            <td><?= $p->categoria ?></td>
            <td>
                <a href="/dashboard/etiqueta/show/<?= $p->id ?>" class="btn btn-secondary btn-sm mt-1" >Show</a>
                <a href="/dashboard/etiqueta/edit/<?= $p->id ?>" class="btn btn-primary btn-sm mt-1" >Edit</a>

                <form action="/dashboard/etiqueta/delete/<?= $p->id ?>" method="post">
                    <button type="submit" class="btn btn-danger btn-sm mt-1" >Delete</button>
                </form>

            </td>
        </tr>
    <?php endforeach ?>
</table>
<?= $pager->links() ?>
<?= $this->endSection() ?>