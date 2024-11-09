<?php
require_once './app/models/siniestro.api.model.php';
require_once './app/views/json.view.php';

class SiniestroApiController{
    private $view;
    private $model;

    public function__construct($res){
        $this->model = new SiniestroModel();
        $this->view = new JSONView();
    }

    //obtengo TODOS los siniestros de la db
    // va a ser llamado desde /api/siniestros
    public function getAll($req, $res){
        $siniestros = $this->model->getSiniestros();
        //los mando a la vista
        return $this->view->response($siniestros);
    }

    //obtengo UN sinierstro en particular
    //esto va a ser llamado desde algo como /api/siniestros/:id
    public function get($req, $res){
        //obtengo el id del siniestro de los parametros desde la ruta
        $id= $req->params->id;
        //obtengo el siniestro de la db
        $siniestro = $this->model-> getSiniestro($id);
        //lo mando a la vista
        return $this->view->response($siniestro);
    }
}