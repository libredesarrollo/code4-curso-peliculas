<label for="titulo">Título</label>
<input type="text" name="titulo" placeholder="Título" id="titulo" value="<?= $pelicula['titulo'] ?>">
<label for="descripcion">Descripción</label>
<textarea name="descripcion" id="descripcion">
            <?= $pelicula['descripcion'] ?>
        </textarea>
<button type="submit"><?= $op ?></button>