<?php

namespace App\Controllers\Api;

use App\Models\PeliculaEtiquetaModel;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController
{

    protected $modelName = 'App\Models\PeliculaModel';
    // protected $format = 'json';
    // protected $format = 'xml';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function paginado()
    {
        return $this->respond($this->model->paginate(10));
    }

    public function paginado_full()
    {
        $peliculas = $this->model
            ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
                $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
                $query->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
            })
            ->when($this->request->getGet('categoria_id'), static function ($query, $categoriaId) {
                $query->where('peliculas.categoria_id', $categoriaId);
            })
            ->when($this->request->getGet('etiqueta_id'), static function ($query, $etiquetaId) {
                $query->where('etiquetas.id', $etiquetaId);
            })
            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left');

        $peliculas = $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate();

        return $this->respond($peliculas);
    }

    public function index_por_categoria($categoriaId)
    {
        $peliculas = $this->model
            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->where('peliculas.categoria_id', $categoriaId)
            ->groupBy('peliculas.id')->paginate();

        return $this->respond($peliculas);
    }

    public function index_por_etiqueta($etiquetaId)
    {
        $peliculas = $this->model
            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->where('etiquetas.id', $etiquetaId)->groupBy('peliculas.id')->paginate();

        return $this->respond($peliculas);
    }

    public function show($id = null)
    {
        $data = [
            'pelicula' => $this->model->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_id')->find($id),
            'imagenes' => $this->model->getImagesById($id),
            'etiquetas' => $this->model->getEtiquetasById($id),
        ];

        return $this->respond($data);
    }

    public function create()
    {
        if ($this->validate('peliculas')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id'),
            ]);
        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }

    public function update($id = null)
    {
        if ($this->validate('peliculas')) {
            $this->model->update($id, [
                'titulo' => $this->request->getRawInput()['titulo'],
                'descripcion' => $this->request->getRawInput()['descripcion'],
                'categoria_id' => $this->request->getRawInput()['categoria_id']
            ]);
        } else {

            if ($this->validator->getError('titulo')) {
                return $this->respond($this->validator->getError('titulo'), 400);
            }

            if ($this->validator->getError('descripcion')) {
                return $this->respond($this->validator->getError('descripcion'), 400);
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

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_id', $etiquetaId)->where('pelicula_id', $peliculaId)->first();

        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);
        }

        return $this->respond('ok');
    }

    public function etiqueta_delete($id, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $id)->delete();

        echo '{"mensaje":"Eliminado"}';

        return $this->respond('ok');
    }
}
