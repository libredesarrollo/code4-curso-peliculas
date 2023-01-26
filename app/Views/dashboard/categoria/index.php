<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('header') ?>
Listado de categorías
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>

<a class="btn btn-success btn-lg mb-4" href="/dashboard/categoria/new">Crear</a>
<table class="table">

    <tr>
        <th>
            Id
        </th>
        <th>
            Título
        </th>
        <th>
            Opciones
        </th>
    </tr>
    <?php foreach ($categorias as $key => $p) : ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->titulo ?></td>
            <td>
                <a href="/dashboard/categoria/show/<?= $p->id ?>" class="btn btn-secondary btn-sm mt-1">Show</a>
                <a href="/dashboard/categoria/edit/<?= $p->id ?>" class="btn btn-primary btn-sm mt-1">Edit</a>

                <form action="/dashboard/categoria/delete/<?= $p->id ?>" method="post">
                    <button class="btn btn-danger btn-sm mt-1" type="submit">Delete</button>
                </form>

            </td>
        </tr>
    <?php endforeach ?>

</table>
<?= $pager->links() ?>
<?= $this->endSection() ?>