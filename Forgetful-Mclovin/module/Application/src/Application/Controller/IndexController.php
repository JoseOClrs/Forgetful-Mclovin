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
use Application\Model\Index;

class IndexController extends AbstractActionController {

    public function indexAction() {
        session_destroy();
        session_start();

        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
        $indexModel = new Index($this->dbAdapter);


        if ($this->getRequest()->isXmlHttpRequest()) {
            //para AJAX
        } else if ($this->getRequest()->isPost()) {
            //Desde formulario POST
            //Recuperar los datos de los campos del formulario
            $datosFormularios = $this->request->getPost()->toArray();
//
//           echo '<pre>';
//           print_r($datosFormularios);         
//           exit;  

            $usuario = $datosFormularios['usuario'];
            $contrasenia = $datosFormularios['contrasenia'];

            

            $logging = $indexModel->obtenerusuario($usuario, $contrasenia);
            $idU = $logging['id'];
            $usu = $logging['usuario'];

//         echo '<pre>';
//         print_r($logging);          
//         exit;  

            if ($logging == 0) {
                //En caso de error 
                return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
            } else {
                //En caso correcto
                session_destroy();
                session_start();
                $_SESSION['auth'] = '1';
                $_SESSION['id'] = $idU;
                $_SESSION['usuario'] = $usu;

//                $iiii=$_SESSION['Id_Usuario'];
//                echo '<pre>';  print_r('ID='. $iiii);  exit;  /       


                $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

                return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/principal");
            }
        } else {
            //Normal GET

            return new ViewModel();
        }
    }

}
