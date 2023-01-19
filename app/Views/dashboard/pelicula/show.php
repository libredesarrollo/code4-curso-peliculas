<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>
<h1><?= $pelicula->titulo ?></h1>
<p><?= $pelicula->descripcion ?></p>

<h3>Imágenes</h3>

<ul>
    <?php foreach ($imagenes as $i) : ?>
        <li>
            <img src="/uploads/peliculas/<?= $i->imagen ?>" width="200">
            <form action="<?= route_to('pelicula.borrar_imagen', $pelicula->id, $i->id) ?>" method="post">
                <button type="submit">Borrar</button>
            </form>
            <form action="<?= route_to('pelicula.descargar_imagen', $i->id) ?>" method="get">
                <button type="submit">Descargar</button>
            </form>
        </li>
    <?php endforeach ?>
</ul>

<h3>Etiquetas</h3>

<?php foreach ($etiquetas as $e) : ?>
    <!-- <form action="<?= route_to('pelicula.etiqueta_delete', $pelicula->id, $e->id) ?>" method="post"> -->
    <button data-url='<?= route_to('pelicula.etiqueta_delete', $pelicula->id, $e->id) ?>' class="delete_etiqueta"><?= $e->titulo ?></button>
    <!-- </form> -->
<?php endforeach ?>
<script>
    document.querySelectorAll('.delete_etiqueta').forEach((b) => {
        //console.log(b.getAttribute('data-url'))
        b.onclick = function(event) {
            //console.log(this.getAttribute('data-url'))
            fetch(this.getAttribute('data-url'), {
                    method: 'POST'
                }).then(res => res.json())
                .then(res => {
                    window.location.reload()
                    //console.log(res)
                })

        }

    })
</script>


<?= $this->endSection() ?>