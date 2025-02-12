<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController
{
    protected $modelName = 'App\Models\PeliculaModel';
    //protected $format    = 'xml';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
     
        return $this->respond($this->model->find($id));
    }

    public function delete($id = null)
    {

        $this->model->delete($id);
        // return $this->respond();
        return $this->respondDeleted(['message' => 'Recurso eliminado']);
    }


    public function create()
    {

        if (!$this->validate('peliculas')) {

            // if ($this->validator->getError("titulo"))
            //     return $this->respond($this->validator->getError("titulo"), 400);

            // if ($this->validator->getError("descripcion"))
            //     return $this->respond($this->validator->getError("descripcion"), 400);

            return $this->respond($this->validator->getErrors(), 400);
        }
   

        $id = $this->model->insert([
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'categoria_id' => $this->request->getPost('categoria_id'),
        ]);

        return $this->respond($this->model->find($id));
    }

    public function update($id = null)
    {
        // json
        // var_dump($this->request->getJSON()->title);
        // return ;
        // if (!$this->validate('peliculas')) {

        //     // if ($this->validator->getError("titulo"))
        //     //     return $this->respond($this->validator->getError("titulo"), 400);

        //     // if ($this->validator->getError("descripcion"))
        //     //     return $this->respond($this->validator->getError("descripcion"), 400);

        //     return $this->respond($this->validator->getErrors(), 400);
        // }

        $this->model->update($id, [
            // 'titulo' => $this->request->getRawInput()['titulo'],
            // 'descripcion' => $this->request->getRawInput()['descripcion'],
            'titulo' => $this->request->getJSON()->title,
            'descripcion' => $this->request->getJSON()->description,
            'categoria_id' => $this->request->getJSON()->category_id,
            // 'titulo' => $this->request->getPost('titulo'),
            // 'descripcion' => $this->request->getPost('descripcion'),
        ]);

        return $this->respond($this->model->find($id));
    }
}
