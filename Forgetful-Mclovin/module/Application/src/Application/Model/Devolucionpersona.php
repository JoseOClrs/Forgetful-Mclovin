<?php


namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Devolucionpersona extends TableGateway {

    private $dbAdapter;

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null) {
        $this->dbAdapter = $adapter;
        return parent::__construct('devolucionpersona', $adapter, $databaseSchema, $selectResultPrototype);
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

   

    
    public function obtenerpersonas() {
         $SQL = "SELECT * FROM persona ";
        
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

        return $rs->toArray();
    }
    
    public function obtenerobjetos() {
         $SQL = "SELECT * FROM objeto ";
  
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

        return $rs->toArray();
    }
    
    public function obtenerobjetosPrestamos($id) {
         $SQL = "SELECT o.id AS idObjeto,o.nombre AS nombreObjeto, p.id AS idPersona,p.nombre,p.segundoNombre,p.apellido,p.segundoApellido,pp.idPersona AS idpersonaprestamos, pp.idObjeto AS idObjetoPrestamo,pp.cantidad,pp.descripcion,pp.id AS idPrestamos

               FROM objeto AS o, persona AS p, prestamopersona AS pp

              WHERE p.id=pp.idPersona AND o.id=pp.idObjeto AND pp.estado='activo' AND p.id=$id";
  
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

        return $rs->toArray();
    }
    
     public function obtenerobjetoAdevolver($id) {
         $SQL = "SELECT o.id AS idObjeto,o.nombre AS nombreObjeto, p.id AS idPersona,p.nombre,p.segundoNombre,p.apellido,p.segundoApellido,pp.idPersona AS idpersonaprestamos, pp.idObjeto AS idObjetoPrestamo,pp.cantidad,pp.descripcion,pp.id AS idPrestamos

               FROM objeto AS o, persona AS p, prestamopersona AS pp

              WHERE p.id=pp.idPersona AND o.id=pp.idObjeto AND pp.estado='activo' AND pp.id=$id  ";
         
  
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

        return  $rs->current();
    }
    
    
   
}
