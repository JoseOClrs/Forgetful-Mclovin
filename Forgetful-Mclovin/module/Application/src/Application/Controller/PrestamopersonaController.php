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
use Application\Model\Prestamopersona;

class PrestamopersonaController extends AbstractActionController {

    public function prestamopersonaAction() {
        if (isset($_SESSION['auth'])) {

            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

            $prestamopersonaModel = new Prestamopersona($this->dbAdapter);


            $personas = $prestamopersonaModel->obtenerpersonas();
            $objetos = $prestamopersonaModel->obtenerobjetos();



            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();
                $datosFormularios['fechaPrestamo'] = date('Y-m-d');
                $datosFormularios['estado'] = "activo";


//            unset($datosFormularios['estado']);
//
//                         echo '<pre>';
//                       print_r($datosFormularios);
//                  exit;


                $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');


                $prestamopersonaModel = new Prestamopersona($this->dbAdapter);


                $idPersona = $datosFormularios['idPersona'];
                $comprobarDatos = $idPersona;

//          echo'<pre>';
//          print_r($comprobarDatos);
//           exit;
//          echo'<pre>';
//          print_r($datosFormularios['nombre'] );
//           exit;
//           
                if ($comprobarDatos == '') {

                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/prestamopersona");
                } else {

                    if ($prestamopersonaModel->agregarNuevo($datosFormularios) == 0) {
                        //En caso de error al guardar
                    } else {
                        //En caso de guardado correcto




                        echo "<script type='text/javascript'>alert('Se guardo correctanmente');</script>";
                        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
                    }
                }// fin if de comprobacion 
            } else {
                //Normal GET


                return new ViewModel(array('personas' => $personas, 'objetos' => $objetos));
            }
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }

}
