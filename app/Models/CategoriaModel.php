<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'categorias';
    protected $returnType = 'object';
    protected $allowedFields = ['titulo'];
}
