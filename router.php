<?php
require_once 'libs/router.php';
require_once './app/controllers/siniestro.api.controller.php';
$router = new Router();


//acá cargamos las rutas
                    //endpoint       verbo   controller               metodo
$router->addRoute('siniestros'     , 'GET', 'SiniestroApiController', 'getAll');
$router->addRoute('siniestros/:id' , 'GET', 'SiniestroApiController', 'get');

//acá lo llamamos. le pasamos el recurso o la ruta
$router->route($_GET['resource'], $SERVER['REQUEST_METHOD']); //busca la que matchea y llama al controlador