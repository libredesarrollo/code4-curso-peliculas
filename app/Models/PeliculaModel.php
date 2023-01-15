<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table = 'peliculas';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'descripcion', 'categoria_id'];

    public function getImagesById($id)
    {
        return $this->select("i.*")
            ->join('pelicula_imagen as pi', 'pi.pelicula_id = peliculas.id')
            ->join('imagenes as i', 'i.id = pi.imagen_id')
            ->where('peliculas.id', $id)
            ->findAll();
    }

    public function getEtiquetasById($id)
    {
        return $this->select('e.*')
            ->join('pelicula_etiqueta as pe', 'pe.pelicula_id = peliculas.id')
            ->join('etiquetas as e', 'e.id = pe.etiqueta_id')
            ->where('peliculas.id', $id)
            ->findAll();
    }
}
