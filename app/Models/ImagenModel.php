<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table            = 'imagenes';
    protected $primaryKey       = 'id';
    protected $returnType = 'object';
    protected $allowedFields    = ['imagen', 'extension', 'data'];


    public function getPeliculasById($id)
    {
        return $this->select("p.*")
            ->join('pelicula_imagen as pi', 'pi.imagen_id = imagenes.id')
            ->join('peliculas as p', 'p.id = pi.pelicula_id')
            ->where('imagenes.id', $id)
            ->findAll();
    }
}
