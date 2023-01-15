<label for="titulo">Título</label>
<input type="text" name="titulo" placeholder="Título" id="titulo" value="<?= old('titulo', $pelicula->titulo) ?>">

<label for="categoria_id">Categoría</label>

<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach ($categorias as $c) : ?>
        <option <?= $c->id !== old('categoria_id', $pelicula->categoria_id) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
    <?php endforeach ?>
</select>

<label for="descripcion">Descripción</label>
<textarea name="descripcion" id="descripcion">
            <?= old('descripcion', $pelicula->descripcion) ?>
        </textarea>
<button type="submit"><?= $op ?></button>