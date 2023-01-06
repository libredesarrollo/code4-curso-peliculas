<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        //$this->db->table('categorias');
        $categoriaModel = new CategoriaModel();

        //$this->db->table('categorias')
        
        $categoriaModel->where('id >=', 1)->delete();

        for ($i = 0; $i < 20; $i++) {
            //$this->db->table('categorias')
            
            $categoriaModel->insert(
                [
                    'titulo' => "Categoria $i"
                ]
            );
        }
    }
}
