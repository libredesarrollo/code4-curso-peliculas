<label for="titulo">Título</label>
<input type="text" name="titulo" placeholder="Título" id="titulo" value="<?= old('titulo', $etiqueta->titulo) ?>">

<label for="categoria_id">Categoría</label>

<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach ($categorias as $c) : ?>
        <option <?= $c->id !== old('categoria_id', $etiqueta->categoria_id) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
    <?php endforeach ?>
</select>

<button type="submit"><?= $op ?></button>