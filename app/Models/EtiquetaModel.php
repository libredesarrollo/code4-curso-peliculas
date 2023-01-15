<?php

namespace App\Models;

use CodeIgniter\Model;

class EtiquetaModel extends Model
{
    protected $table            = 'etiquetas';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields   = [ 'titulo','categoria_id' ];
}
