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
use Application\Model\Prestamopersona;

class DevolucionpersonaController extends AbstractActionController {

    public function devolucionpersonaAction() {
        if (isset($_SESSION['auth'])) {
            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

            $devolucionpersonaModel = new Devolucionpersona($this->dbAdapter);
            $personas = $devolucionpersonaModel->obtenerpersonas();

            // $_SESSION['formulario']=1;

            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();
//            $datosFormularios['fechaDevolucion'] = date('Y-m-d');
//            $datosFormularios['estado'] = "activo";
//               echo '<pre>'; print_r($datosFormularios); exit;

                $idPersona = $datosFormularios['idPersona'];

                if ($idPersona == '') {
                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/devolucionpersona");
                }

                $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
                $devolucionpersonaModel = new Devolucionpersona($this->dbAdapter);

                $prestamo = $devolucionpersonaModel->obtenerobjetosPrestamos($idPersona);

//          echo '<pre>'; print_r($prestamo); exit;            
//            echo '<pre>'; print_r($datosFormularios); exit;
                return new ViewModel(array('prestamos' => $prestamo, 'personas' => $personas));
                //           $nombrePersona = $datosFormularios['nombre'];

            } else {
                //Normal GET
                return new ViewModel(array('personas' => $personas));
            }
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }

    public function devolucionObjetoAction() {
        if (isset($_SESSION['auth'])) {

            $Id_Prestamo = $this->params()->fromRoute("id", null);
            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
            $prestamopersonaModel = new Prestamopersona($this->dbAdapter);

            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
            $devolucionpersonaModel = new Devolucionpersona($this->dbAdapter);

            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();
                $datosFormularios['fechaDevolucion'] = date('Y-m-d');
                $datosFormularios['estado'] = "activo";
                $datosFormularios['idPrestamoPersona'] = $Id_Prestamo;

                $datosFormularios2['estado'] = "inactivo";

                //    echo '<pre>'; print_r($datosFormularios); exit;

                if ($devolucionpersonaModel->agregarNuevo($datosFormularios) == 0 || $prestamopersonaModel->actualizar($Id_Prestamo, $datosFormularios2) == 0) {
//En caso de error al guardar
                } else {
//En caso de guardado correcto

                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
                }
            } else {
                //Normal GET

                $prestamo = $prestamopersonaModel->getPorId($Id_Prestamo);
                $idObjeto = $prestamo['id'];


                $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
                $devolucionpersonaModel = new Devolucionpersona($this->dbAdapter);
                $objetosprestado = $devolucionpersonaModel->obtenerobjetoAdevolver($idObjeto);

                //         echo '<pre>'; print_r($objetosprestado); exit;

                if (!$objetosprestado) {
                    //retornar error
                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/devolucionpersona");
                }


                return new ViewModel(array('dat' => $objetosprestado));
            }
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }

}
