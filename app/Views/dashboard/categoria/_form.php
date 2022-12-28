<label for="titulo">Título</label>
<input type="text" name="titulo" placeholder="Título" id="titulo" value="<?= old('titulo', $categoria->titulo) ?>">
<button type="submit"><?= $op ?></button>