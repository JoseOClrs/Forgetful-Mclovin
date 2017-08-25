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
use Application\Model\Principal;


class PrincipalController extends AbstractActionController
{
    public function principalAction()
    {
        if (isset($_SESSION['auth']) ) {
         $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

        $principalModel = new Principal($this->dbAdapter);


        $prestamos = $principalModel->obtenerprestamos();


//        echo '<pre>';
//        print_r($prestamos);
//        exit;
        return new ViewModel(array('prestamos' => $prestamos));
       } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }
}
