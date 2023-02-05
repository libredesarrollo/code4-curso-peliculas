<?= $this->extend('Layouts/blog')  ?>
<?= $this->section('contenido')  ?>

<h1>Peliculas</h1>
<hr>

<div class="card my-3 text-bg-primary">
    <div class="card-body">
        <form method="get">
            <div class="d-flex gap-2">
                <select class="form-control flex-grow-1 categoria_id" name="categoria_id">
                    <option value="">Categoría </option>
                    <?php foreach ($categorias as $c) : ?>
                        <option <?= $c->id !== $categoria_id ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-control etiqueta_id" name="etiqueta_id">
                    <option value="">Etiqueta</option>
                    <?php foreach ($etiquetas as $e) : ?>
                        <option <?= $e->id !== $etiqueta_id ?: 'selected' ?> value="<?= $e->id ?>"><?= $e->titulo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex gap-2 mt-2">
                <input placeholder="Buscar..." class="form-control" type="text" name="buscar" value=<?= $buscar ?>>
                <input class="btn btn-secondary" type="submit" value="Enviar">
                <a style="width: 150px;" class="btn btn-success" href="<?= route_to('blog.pelicula.index') ?>">Limpiar Filtro</a>
            </div>
        </form>
    </div>
</div>

<?= view('partials/_peliculas'/*, ['peliculas' => $peliculas]*/) ?>

<script>
    document.querySelector('.categoria_id').addEventListener('change', () => {
        fetch('/blog/etiquetas_por_categoria/' + document.querySelector('.categoria_id').value)
            .then(res => res.json())
            .then(res => {
                console.log(res);

                var etiquetas = '<option value="">Etiqueta</option>';

                res.forEach((e) => {
                    etiquetas += `
                <option value="${e.id}">${e.titulo}</option>
                `
                })

                document.querySelector('.etiqueta_id').innerHTML = etiquetas

            })

    })
</script>


<?= $this->endSection()  ?>