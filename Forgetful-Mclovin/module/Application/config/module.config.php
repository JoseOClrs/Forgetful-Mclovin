<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
//Ruteo
            //Ruta para el controlador Personas
            'Persona' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/persona',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Persona',
                        'action' => 'persona',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    //SUB RUTAS
                    //subruta  crear persona
                    'crearpersona' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/crearpersona',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Persona',
                                'action' => 'crearpersona',
                            ),
                        ),
                    ),
                    //Fin subruta crear persona
                //sub editar administrarpersona
                    'administrarpersona' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/administrarpersona/:id',
                            //Aqui los contraints
                            'constraints' => array(
                                'id' => '[0-9]+', //Expresión regular que acepta
                            ),
                            'defaults' => array(
                                'controller' => 'Application\Controller\Persona',
                                'action' => 'administrarpersona',
                            ),
                        ),
                    ),
//Fin Sub administrarpersona
                ),
            ), //Fin controlador  Personas
            
            
            
            //Ruta para el controlador Objetos
            'Objeto' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/objeto',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Objeto',
                        'action' => 'objeto',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    //SUB RUTAS
                    //subruta  crear Objetos
                    'crearobjeto' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/crearobjeto',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Objeto',
                                'action' => 'crearobjeto',
                            ),
                        ),
                    ),
                    //Fin subruta crear Objetos
                //sub editar administrarObjetos
                    'administrarobjeto' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/administrarobjeto/:id',
                            //Aqui los contraints
                            'constraints' => array(
                                'id' => '[0-9]+', //Expresión regular que acepta
                            ),
                            'defaults' => array(
                                'controller' => 'Application\Controller\Objeto',
                                'action' => 'administrarobjeto',
                            ),
                        ),
                    ),
//Fin Sub administrarObjetos
                ),  
            ), //Fin controlador  Objetos
            
            
            
             //Ruta para el controlador Prestamos
            'Prestamopersona' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/prestamopersona',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Prestamopersona',
                        'action' => 'prestamopersona',
                    ),
                ),
                ),//Fin Ruta para el controlador Prestamos
            
            
                //Ruta para el controlador Devoluciones
            'Devolucionpersona' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/devolucionpersona',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Devolucionpersona',
                        'action' => 'devolucionpersona',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    //SUB RUTAS
                    //subruta  delvolver Objeto
                    'devolucionobjeto' => array(
                        'type' => 'Segment',
                         'options' => array(
                            'route' => '/devolucionobjeto/:id',
                            //Aqui los contraints
                            'constraints' => array(
                                'id' => '[0-9]+', //Expresión regular que acepta
                            ),
                            'defaults' => array(
                                'controller' => 'Application\Controller\Devolucionpersona',
                                'action' => 'devolucionobjeto',
                            ),
                        ),
                    ),
                    ),
                    //Fin subruta delvolver Objeto
                ),//Fin Ruta para el controlador Devoluciones
            
            
                 //Ruta para el controlador Historial
            'Historial' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/historial',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Historial',
                        'action' => 'historial',
                    ),
                ),
                ),//Fin Ruta para el controlador Historial
            
               //Ruta para el controlador Principal
            'Principal' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/principal',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Principal',
                        'action' => 'principal',
                    ),
                ),
                ),//Fin Ruta para el controlador Principal
            
            
        ),//Fin de rutas
    ),
    //FIN de Ruteo
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        // Nombrar el acceso para la base de datos.
        'factories' => array(
            'Zend\Db\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
        // FIN Nombrar el acceso para la base de datos.
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    //Controladores Invocables   
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Objeto' => 'Application\Controller\ObjetoController',
            'Application\Controller\Persona' => 'Application\Controller\PersonaController',
            'Application\Controller\Prestamopersona' => 'Application\Controller\PrestamopersonaController',
            'Application\Controller\Devolucionpersona' => 'Application\Controller\DevolucionpersonaController',
            'Application\Controller\Historial' => 'Application\Controller\HistorialController',
            'Application\Controller\Principal' => 'Application\Controller\PrincipalController'
        ),
    ),
    //FIN Controladores Invocables
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
