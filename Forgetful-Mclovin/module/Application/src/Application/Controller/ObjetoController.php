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
use Application\Model\Objeto;

class ObjetoController extends AbstractActionController {

    public function objetoAction() {
        if (isset($_SESSION['auth'])) {

            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

            $objetoModel = new Objeto($this->dbAdapter);


            $objetoss = $objetoModel->getAll();


//        echo '<pre>';
//        print_r($objetoss);
//        exit;
            return new ViewModel(array('objetos' => $objetoss));
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }

    public function crearobjetoAction() {
        if (isset($_SESSION['auth'])) {

            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();
                $datosFormularios['estado'] = "activo";
//            $datosFormularios['fecha'] = date('Y-m-d H:i:s');
//            unset($datosFormularios['estado']);
//
//                         echo '<pre>';
//                       print_r($datosFormularios);
//                  exit;


                $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');


                $objetoModel = new Objeto($this->dbAdapter);


                $nombre = $datosFormularios['nombre'];
                $comprobarDatos = $nombre;

//          echo'<pre>';
//          print_r($comprobarDatos);
//           exit;
//          echo'<pre>';
//          print_r($datosFormularios['nombre'] );
//           exit;
//           
                if ($comprobarDatos == '') {

                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/objeto/crearobjeto");
                } else {

                    if ($objetoModel->agregarNuevo($datosFormularios) == 0) {
                        //En caso de error al guardar
                    } else {
                        //En caso de guardado correcto




                        echo "<script type='text/javascript'>alert('Se guardo correctanmente');</script>";
                        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/objeto");
                    }
                }// fin if de comprobacion 
            } else {
                //Normal GET


                return new ViewModel();
            }
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }

    public function administrarobjetoAction() {

        if (isset($_SESSION['auth'])) {

            $Id_Objeto = $this->params()->fromRoute("id", null);
            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

            $objetoModel = new Objeto($this->dbAdapter);


            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();

                if ($objetoModel->actualizar($Id_Objeto, $datosFormularios) == 0) {
//En caso de error al guardar
                } else {
//En caso de guardado correcto


                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/objeto");
                }
            } else {
                //Normal GET

                $obj = $objetoModel->getPorId($Id_Objeto);
//            print_r($depto);exit;
                //validar que existe
                if (!$obj) {
                    //retornar error
                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
                }


                return new ViewModel(array('dat' => $obj));
            }

//        echo '<pre>';
//        print_r($personas);
//        exit;
            return new ViewModel();
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }

}
