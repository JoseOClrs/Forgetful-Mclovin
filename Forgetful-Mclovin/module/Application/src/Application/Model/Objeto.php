<?php

/* 

 * @Nombre    : Objeto

 * @Creado el : Error: on line 8, column 32 in Templates/Licenses/license-default.txt
The string doesn't match the expected date/time format. The string to parse was: "10-12-2016". The expected format was: "dd-MMM-yyyy"., 08:35:09 PM
 */


namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Objeto extends TableGateway {

    private $dbAdapter;

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null) {
        $this->dbAdapter = $adapter;
        return parent::__construct('objeto', $adapter, $databaseSchema, $selectResultPrototype);
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

    public function borrar($id) {
        return $this->delete(array('id' => $id));
    }

    /* Ejemplo de consulta con query SQL */
    /*
      public function getEntrevistasExcel($fechaIni = 'todo', $fechaFin = null) {
      $conId = "";
      if ($fechaIni == "todo") {
      $conId = "";
      }else{
      $conId = "AND e.fecha >= '$fechaIni' AND e.fecha<='$fechaFin' ";
      }
      $SQL = "SELECT e.identidad, p.nombres, p.apellidos, p.direccion, date_format(p.fecha_nacimiento, '%d/%m/%Y') as fecha_nacimiento, "
      . "((YEAR(CURDATE())-YEAR(p.`fecha_nacimiento`)) - (RIGHT(CURDATE(),5)<RIGHT(p.`fecha_nacimiento`,5))) AS edad, "
      . "p.telefono, p.celular, n.nombre_nivel AS nivel, "
      . "p.genero, z.nombre_zona AS zona, p.correo, "
      . "date_format(p.fecha_ingreso_ayo, '%d/%m/%Y') AS fecha_ingreso_ayo, "
      . "date_format(e.fecha, '%d/%m/%Y') as fecha, ce.nombre_centro AS centro, g.nombre_grado AS grado, "
      . "pa. nombre_madre AS nombres_enc, e.motivo_consulta AS motivo, e.diagnostico "
      . ""
      . " "
      . "FROM psi_entrevistas AS e, psi_pacientes AS pa, personas AS p, niveles_educativos AS n, zonas AS z, centros_educativos AS ce, grados AS g "
      . "WHERE e.identidad = p.identidad "
      . "AND e.id_nivel_educativo_part = n.id_nivel "
      . "AND z.id_zona = p.id_zona "
      . "AND ce.id_centro = e.id_centro_educativo_part "
      . "AND g.id_grado = e.id_grado_part "
      . "AND pa.identidad = e.identidad "
      . $conId. " "
      . "ORDER BY e.fecha";

      $rs = $this->dbAdapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);

      return $rs->toArray();
      } */
    
    
    
}