<?php

class AseguradoraModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=peritajes;charset=utf8', 'root', '');
     }

    public function getAseguradoras(){
        $query = $this -> db->prepare('SELECT * FROM aseguradora');
        $query->execute();
        $aseguradoras = $query -> fetchAll(PDO::FETCH_OBJ);
        return $aseguradoras;
    }
    public function getsiniestrosAseguradoraId($id){
        $query = $this -> db->prepare('SELECT * FROM siniestro WHERE ID_Aseguradora=?');
        $query->execute([$id]);
        $siniestrosAseguradoraId = $query -> fetchAll(PDO::FETCH_OBJ);
        return $siniestrosAseguradoraId;

    }

    public function aseguradoraAdd($name, $adress, $email){
        $query = $this -> db->prepare('INSERT INTO aseguradora (Nombre,Direccion, Mail) VALUES(?,?,?)');
        $query -> execute([$name, $adress, $email]);
        $id = $this->db->lastInsertId();    
        return $id;
    }

    public function deleteAseguradora($id){
        $query = $this -> db->prepare('DELETE FROM aseguradora WHERE ID_Aseguradora=?');
        $query->execute([$id]);


    }

    public function modifyAseguradora($id){
        $query = $this->db->prepare('SELECT * FROM aseguradora WHERE ID_Aseguradora=?');
        $query->execute([$id]);   
        $aseguradora = $query->fetch(PDO::FETCH_OBJ);    
        return $aseguradora;

    }

    public function aseguradoraModify( $name, $adress, $email, $id){
       
        $query = $this->db->prepare('UPDATE aseguradora SET Nombre=?, Direccion=?,Mail= ? WHERE ID_Aseguradora= ?' );

       $query->execute([$name, $adress, $email, $id]);
    }


}