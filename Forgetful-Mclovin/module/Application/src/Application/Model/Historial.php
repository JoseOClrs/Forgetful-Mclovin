<?php


namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Historial extends TableGateway {

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

   

    
    public function obtenerprestamos($id) {
         $SQL = "SELECT o.id AS idObjeto,o.nombre AS nombreObjeto, p.id AS idPersona,p.nombre,p.segundoNombre,p.apellido,p.segundoApellido,pp.cantidad,pp.descripcion,pp.fechaPrestamo,pp.id AS idPrestamos


               FROM objeto AS o, persona AS p, prestamopersona AS pp

              WHERE p.id=$id AND p.id=pp.idPersona AND o.id=pp.idObjeto AND pp.estado='activo' ";
        
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

        return $rs->toArray();
    }
    
    public function obtenerdevoluciones($id) {
         $SQL = "SELECT  o.id AS idObjeto,o.nombre AS nombreObjeto, p.id AS idPersona,p.nombre,p.segundoNombre,p.apellido,p.segundoApellido,
dp.fechaDevolucion,dp.descripcion AS descripcionDevolucion,dp.cantidad AS catidadDevoluion,dp.id AS idDevolucion,

pp.fechaPrestamo,pp.descripcion,pp.cantidad

               FROM objeto AS o, persona AS p, devolucionpersona AS dp,prestamopersona AS pp

              WHERE  o.id=dp.idObjeto AND p.id=$id AND dp.idPersona=p.id AND dp.idObjeto=pp.idObjeto AND dp.idPrestamoPersona=pp.id";
        
        $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

        return $rs->toArray();
    }

    
    
   
}
