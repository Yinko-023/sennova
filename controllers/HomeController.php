<?php
require_once 'models/PubliModel.php';
require_once "core/controllers.php";

class HomeController extends Controller
{
    public function index()
    {
        $orden = $_GET['orden'] ?? 'recientes';
        $filtro_fecha = $_GET['filtro_fecha'] ?? 'todos';
        $categoria = $_GET['categoria'] ?? '';
        $area = $_GET['area'] ?? ''; 

        $publicacionModel = new Publicacion();
        $publicaciones = $publicacionModel->obtenerPublicacionesFiltradas($orden, $filtro_fecha, $categoria, $area);
        $destacada = $publicacionModel->obtenerDestacada();

        require 'views/home.php';

    }
    public function adminUsuario()
    {
        $publicacionModel = new Publicacion();
        $publicaciones = $publicacionModel->obtenerPublicaciones();
        $destacada = $publicacionModel->obtenerDestacada();

        require 'views/admin/usuario.php';



    }

}
