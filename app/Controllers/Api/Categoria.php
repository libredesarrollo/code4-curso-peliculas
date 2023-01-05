<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Categoria extends ResourceController
{

    protected $modelName = 'App\Models\CategoriaModel';
    // protected $format = 'json';
    // protected $format = 'xml';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        return $this->respond($this->model->find($id));
    }

    public function create()
    {
        if ($this->validate('categorias')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo')
            ]);
        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }

    public function update($id = null)
    {
        if ($this->validate('categorias')) {
            $this->model->update($id, [
                'titulo' => $this->request->getRawInput()['titulo']
            ]);
        } else {
            
            if($this->validator->getError('titulo')){
                return $this->respond($this->validator->getError('titulo'), 400);
            }
        
            //return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respond('ok');
    }
}
