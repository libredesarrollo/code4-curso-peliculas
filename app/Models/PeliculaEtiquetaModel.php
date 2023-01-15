<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaEtiquetaModel extends Model
{
    protected $table            = 'pelicula_etiqueta';
    protected $returnType       = 'object';

    protected $allowedFields   = [ 'pelicula_id','etiqueta_id' ];
}
