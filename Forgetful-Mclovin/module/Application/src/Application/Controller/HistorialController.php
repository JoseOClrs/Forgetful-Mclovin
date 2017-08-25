<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Devolucionpersona;
use Application\Model\Historial;

class HistorialController extends AbstractActionController {

    public function historialAction() {
        if (isset($_SESSION['auth'])) {

            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

            $devolucionpersonaModel = new Devolucionpersona($this->dbAdapter);
            $personas = $devolucionpersonaModel->obtenerpersonas();


            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();


                $idPersona = $datosFormularios['idPersona'];

                if ($idPersona == '') {
                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/devolucionpersona");
                }

                $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
                $historialModel = new Historial($this->dbAdapter);

                $prestamo = $historialModel->obtenerprestamos($idPersona);
                $devolucion = $historialModel->obtenerdevoluciones($idPersona);

//          echo '<pre>'; print_r($prestamo); exit;            
//            echo '<pre>'; print_r($datosFormularios); exit;
                return new ViewModel(array('prestamos' => $prestamo, 'personas' => $personas, 'devoluciones' => $devolucion));
            } else {
                //Normal GET
                return new ViewModel(array('personas' => $personas));
            }
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }

}
