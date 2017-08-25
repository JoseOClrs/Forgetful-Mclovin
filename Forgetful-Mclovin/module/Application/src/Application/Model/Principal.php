<?php


namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Principal extends TableGateway {

    private $dbAdapter;

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null) {
        $this->dbAdapter = $adapter;
        return parent::__construct('', $adapter, $databaseSchema, $selectResultPrototype);
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

   

    
    public function obtenerprestamos() {
         $SQL = "SELECT pp.id, pp.idPersona,pp.idObjeto,pp.fechaPrestamo,pp.descripcion,pp.cantidad,p.id as idPersona, p.nombre,p.segundoNombre,p.apellido,p.segundoApellido,o.id as idObjeto,o.nombre as nombreObjeto
                FROM prestamopersona AS pp,persona AS p, objeto AS o
                WHERE pp.idPersona=p.id AND pp.idObjeto=o.id 
                AND pp.estado='activo'  ORDER by pp.id ASC ";
        
           
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

        return $rs->toArray();
    }
    
    
   
}
