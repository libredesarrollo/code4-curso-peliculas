<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    // public function __construct()
    // {
    //     helper(['cookie', 'date']);
    // }

    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        // var_dump($peliculaModel->asArray()->find($id));
        // var_dump($peliculaModel->asObject()->find($id));

        echo view('dashboard/pelicula/show', [
            'pelicula' => $peliculaModel->find($id),
            'imagenes' => $peliculaModel->getImagesById($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id),
        ]);
    }

    public function new()
    {

        $categoriaModel = new CategoriaModel();

        echo view('dashboard/pelicula/new', [
            'pelicula' => new PeliculaModel(),
            'categorias' => $categoriaModel->find()
        ]);
    }

    public function create()
    {

        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id'),
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->to('/dashboard/pelicula')->with('mensaje', 'Registro gestionado de manera exitosa');
    }

    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();

        echo view('dashboard/pelicula/edit', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->find()
        ]);
    }

    public function update($id)
    {

        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);

            $this->asignar_imagen($id);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->back()->with('mensaje', 'Registro gestionado de manera exitosa');
        // return redirect()->to('/dashboard/pelicula');
        // return redirect()->to('/dashboard/test');
        // return redirect()->route('pelicula.test');
    }

    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);

        return redirect()->back()->with('mensaje', 'Registro gestionado de manera exitosa');
    }

    public function index()
    {

        $peliculaModel = new PeliculaModel();


        // $this->generar_imagen();


        // $db = \Config\Database::connect();
        // $builder = $db->table('peliculas');

        // return $builder->limit(10, 20)->getCompiledSelect();

        $data = [
            'peliculas' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_id')
                ->paginate(10),
            'pager' => $peliculaModel->pager
            //->find()
        ];

        echo view('dashboard/pelicula/index', $data);
    }



    public function etiquetas($id)
    {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];

        if ($this->request->getGet('categoria_id')) {
            $etiquetas = $etiquetaModel
                ->where('categoria_id', $this->request->getGet('categoria_id'))
                ->findAll();
        }

        echo view('dashboard/pelicula/etiquetas', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->findAll(),
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas,
        ]);
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

        return redirect()->back();
    }

    public function etiqueta_delete($id, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $id)->delete();

        echo '{"mensaje":"Eliminado"}';

        //return redirect()->back()->with('mensaje', 'Etiqueta eliminada');
    }

    public function descargar_imagen($imagenId)
    {
        $imagenModel = new ImagenModel();

        $imagen = $imagenModel->find($imagenId);

        if ($imagen == null) {
            return 'no existe imagen';
        }

        //$imageRuta = WRITEPATH . 'uploads/peliculas/' . $imagen->imagen;
        $imageRuta =  'uploads/peliculas/' . $imagen->imagen;

        return $this->response->download($imageRuta, null)->setFileName('imagen.png');
    }

    public function borrar_imagen($peliculaId, $imagenId)
    {
        $imagenModel = new ImagenModel();
        $peliculaModel = new PeliculaModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        $imagen = $imagenModel->find($imagenId);

        //archivo
        if ($imagen == null) {
            return 'no existe imagen';
        }
        //$imageRuta = WRITEPATH . 'uploads/peliculas/' . $imagen->imagen;
        $imageRuta =  'uploads/peliculas/' . $imagen->imagen;
        // archivo

        // eliminar pivote
        $peliculaImagenModel->where('imagen_id', $imagenId)->where('pelicula_id', $peliculaId)->delete();

        if ($peliculaImagenModel->where('imagen_id', $imagenId)->countAllResults() == 0) {
            // eliminar toda la imagen
            unlink($imageRuta);
            $imagenModel->delete($imagenId);
        }

        return redirect()->back()->with('mensaje', 'Imagen Eliminada');
    }

    private function asignar_imagen($peliculaId)
    {

        helper('filesystem');

        if ($imagefile = $this->request->getFile('imagen')) {
            // upload
            if ($imagefile->isValid()) {

                $validated = $this->validate([
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/gif,image/png]',
                    'max_size[imagen,4096]'
                ]);

                if ($validated) {
                    $imageNombre = $imagefile->getRandomName();
                    // $imageNombre = $imagefile->getName();
                    $ext = $imagefile->guessExtension();

                    // $imagefile->move(WRITEPATH . 'uploads/peliculas', $imageNombre);
                    $imagefile->move('../public/uploads/peliculas', $imageNombre);

                    $imagenModel = new ImagenModel();
                    $imagenId = $imagenModel->insert([
                        'imagen' => $imageNombre,
                        'extension' => $ext,
                        'data' => json_encode(get_file_info('../public/uploads/peliculas/' . $imageNombre))
                    ]);

                    $peliculaImagenModel = new PeliculaImagenModel();
                    $peliculaImagenModel->insert([
                        'imagen_id' => $imagenId,
                        'pelicula_id' => $peliculaId,
                    ]);
                }

                return $this->validator->listErrors();
            }
        }
    }

    function image($image)
    {
        // abre el archivo en modo binario
        if (!$image) {
            $image = $this->request->getGet('image');
        }
        $name = WRITEPATH . 'uploads/peliculas/' . $image;

        if (!file_exists($name)) {
            // throw PageNotFoundException::forPageNotFound();
        }

        $fp = fopen($name, 'rb');

        // envía las cabeceras correctas
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($name));

        // vuelca la imagen y detiene el script
        fpassthru($fp);
        exit;
    }
}
