<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}


/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->resource('pelicula');
    $routes->resource('categoria');
});

$routes->group('dashboard', function ($routes) {
    //test user
    // $routes->get('usuario/crear','\App\Controllers\Web\Usuario::crear_usuario');
    // $routes->get('usuario/probar/contrasena','\App\Controllers\Web\Usuario::probar_contrasena');
    // $routes->presenter('categoria', ['only' => ['index', 'new', 'create']]);
    // $routes->presenter('categoria', ['except' => 'show']);
    $routes->get('pelicula/etiqueta/(:num)', 'Dashboard\Pelicula::etiquetas/$1', ['as' => 'pelicula.etiquetas']);
    $routes->post('pelicula/etiqueta/(:num)', 'Dashboard\Pelicula::etiquetas_post/$1', ['as' => 'pelicula.etiquetas']);
    //$routes->post('pelicula/imagen_delete/(:num)', 'Dashboard\Pelicula::borrar_imagen/$1', ['as' => 'pelicula.borrar_imagen']);
    $routes->post('pelicula/imagen_delete/(:num)/(:num)', 'Dashboard\Pelicula::borrar_imagen/$1/$2', ['as' => 'pelicula.borrar_imagen']);
    $routes->get('pelicula/imagen_descargar/(:num)', 'Dashboard\Pelicula::descargar_imagen/$1', ['as' => 'pelicula.descargar_imagen']);
    $routes->post('pelicula/(:num)/etiqueta/(:num)/delete', 'Dashboard\Pelicula::etiqueta_delete/$1/$2', ['as' => 'pelicula.etiqueta_delete']);

    $routes->presenter('pelicula', ['controller' => 'Dashboard\Pelicula']);
    $routes->presenter('etiqueta', ['controller' => 'Dashboard\Etiqueta']);
    $routes->presenter('categoria', ['except' => ['show'], 'controller' => 'Dashboard\Categoria']);
});

$routes->group('blog', function ($routes) {
    // $routes->presenter('', ['controller' => 'Blog\Pelicula', 'only' => ['index', 'show']]);
    $routes->get('', 'Blog\Pelicula::index', ['as' => 'blog.pelicula.index']);
    $routes->get('categorias/(:num)', 'Blog\Pelicula::index_por_categoria/$1', ['as' => 'blog.pelicula.index_por_categoria']);
    $routes->get('etiquetas/(:num)', 'Blog\Pelicula::index_por_etiqueta/$1', ['as' => 'blog.pelicula.index_por_etiqueta']);
    $routes->get('(:num)', 'Blog\Pelicula::show/$1', ['as' => 'blog.pelicula.show']);
    $routes->get('etiquetas_por_categoria/(:num)', 'Blog\Pelicula::etiquetas_por_categoria/$1', ['as' => 'blog.pelicula.etiquetas_por_categoria']);
});

$routes->get('login', '\App\Controllers\Web\Usuario::login', ['as' => 'usuario.login']);
$routes->post('login_post', '\App\Controllers\Web\Usuario::login_post', ['as' => 'usuario.login_post']);

$routes->get('register', '\App\Controllers\Web\Usuario::register', ['as' => 'usuario.register']);
$routes->post('register_post', '\App\Controllers\Web\Usuario::register_post', ['as' => 'usuario.register_post']);

$routes->get('logout', '\App\Controllers\Web\Usuario::logout', ['as' => 'usuario.logout']);

// test
$routes->get('/image/(:any)', 'Dashboard\Pelicula::image/$1', ['as' => 'get_image']);



// HTTP get post put path delete

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
