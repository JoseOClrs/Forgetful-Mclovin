<?php


namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Index extends TableGateway {

    private $dbAdapter;

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null) {
        $this->dbAdapter = $adapter;
        return parent::__construct('usuarios', $adapter, $databaseSchema, $selectResultPrototype);
    }

    public function getAll() {
        $r = $this->select();
        return $r->toArray();
    }

    public function getPorId($id) {
        $idT = (int) $id;
        $rowset = $this->select(array('id' => $idT));
        $fila = $rowset->current();

        if (!$fila) {
            //throw new \Exception("No hay registros asociados al valor $id");
        }

        return $fila;
    }

    public function agregarNuevo($data = array()) {
        return $this->insert($data);
    }

    public function actualizar($id, $data = array()) {
        return $this->update($data, array('id' => $id));
    }

   

  
    public function obtenerusuario($usuario,$contrasenia) {
         $SQL = "SELECT u.id,u.usuario,u.contrasenia "                
                . " "
                . "FROM usuarios AS u "
                . "WHERE u.usuario='$usuario' AND u.contrasenia='$contrasenia' AND u.estado='activo' ";
        
           
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);
           $fila = $rs->current();
        return $fila;
    }
    
    
   
}
