<div class="mb-3">
    <label class="form-label" for="titulo">Título</label>
    <input class="form-control" type="text" name="titulo" placeholder="Título" id="titulo" value="<?= old('titulo', $categoria->titulo) ?>">
</div>
<button type="submit" class="btn btn-primary"><?= $op ?></button>