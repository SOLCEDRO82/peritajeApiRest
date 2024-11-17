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
    // (/api/siniestros)
    public function getAll($req, $res){
        $siniestros = $this->model->getSiniestros();
        //los mando a la vista
        return $this->view->response($siniestros);
    }

    //obtengo UN siniestro en particular
    // (api/siniestros/:id)
    public function get($req, $res){
        //obtengo el id del siniestro de los parametros desde la ruta
        $id= $req->params->id;
        //obtengo el siniestro de la db
        $siniestroById = $this->model-> getSiniestroById($id);
        //valido los datos
        if(!$siniestroById){
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }
        //lo mando a la vista 
        return $this->view->response($siniestroById);
    }

    public function delete($req, $res){
        $id= $req->params->id;

        $siniestro= $this->model->getsiniestroById($id);

        if(!$siniestro){
            return $this->view->response("El siniestro con el id=$id no existe", 404);
        }
        $this->model->deleteSiniestro($id);
        $this->view->response("El siniestro con el id =$id se eliminó con éxito", 200);

    }

    public function add($req,$res){
        //valido los datos
        if(empty($req->body->asegurado.... //agregar categorias))||;{
            return $this->view->response('Faltan completar datos',400);
        }
        //obtengo los datos del body del request
        //uno por uno los objetos del json
        $asegurado = $req->body->asegurado;//lo hace el sistema de ruteo request.php linea10
        $tipo_siniestro =//igual con cada una
        
   
        //inserto los datos$
        $newSiniestro= $this->model->addSiniestro($asegurado, $tipo_siniestro//todos);

        if(!$newSiniestro){
            return $this->view->response ("Error al insertar tarea", 500);
        }
            // buena práctica devuelvo el siniestro insertada
          

            return $this->view->response($newSiniestro,201);

    }

    public function update($req, $res){
        $id= $req->params->id;//qué siniestro quiero actualizar

        $siniestro= $this->model->getsiniestroById($id);

        if(!$siniestro){//verifico que exista
            return $this->view->response("El siniestro con el id=$id no existe", 404);
        }

        //valido los datos
        if(empty($req->body->asegurado.... //agregar categorias))||;{
            return $this->view->response('Faltan completar datos',400);
        }

        //obtengo los datos del body del request
        //uno por uno los objetos del json
        $asegurado = $req->body->asegurado;//lo hace el sistema de ruteo request.php linea10
        $tipo_siniestro =//igual con cada una

        //modifico si pasa las validaciones
        $modifySiniestro=$this->model->siniestroModify(//todos los parametros);//metodo del modelo para modificar

        //obtengo la tarea modificada y la muestro
        
        $this->view->response ($modifySiniestro, 200);

        

    }


}