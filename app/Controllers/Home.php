<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // 0/0;
        echo 'Hola Mundo';
        return view('welcome_message');
    }

    public function update($id, $otro=5)
    {
        echo $id.' '. $otro;
        // editar registro
    }
}
