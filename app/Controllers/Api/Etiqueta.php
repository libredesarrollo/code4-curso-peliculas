<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Etiqueta extends ResourceController
{

    protected $modelName = 'App\Models\EtiquetaModel';
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
        if ($this->validate('etiquetas')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }

    public function update($id = null)
    {
        if ($this->validate('etiquetas')) {
            $this->model->update($id, [
                'titulo' => $this->request->getRawInput()['titulo'],
                'categoria_id' => $this->request->getRawInput()['categoria_id']
            ]);
        } else {

            if ($this->validator->getError('titulo')) {
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
