<label for="titulo">Título</label>
<input type="text" name="titulo" placeholder="Título" id="titulo" value="<?= old('titulo', $pelicula['titulo']) ?>">
<label for="descripcion">Descripción</label>
<textarea name="descripcion" id="descripcion">
            <?= old('descripcion', $pelicula['descripcion']) ?>
        </textarea>
<button type="submit"><?= $op ?></button>