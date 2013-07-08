<?php
namespace ProjetosEspeciais;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'acl' => array(
        'ProjetosEspeciais' => array(
            'PROJETOS ESPECIAIS' => array(
                'ProjetosEspeciais\Controller\Index:index',
                'ProjetosEspeciais\Controller\Helpdesk:index',
                'ProjetosEspeciais\Controller\Helpdesk:chamado',
                'ProjetosEspeciais\Controller\Helpdesk:resposta',
                'ProjetosEspeciais\Controller\Helpdesk:store',
                'ProjetosEspeciais\Controller\Helpdesk:close',
                'ProjetosEspeciais\Controller\Helpdesk:changeprioridade',
                'ProjetosEspeciais\Controller\Helpdesk:avaliar',
                'ProjetosEspeciais\Controller\Helpdesk:indicadores',
            ),
            'TI' => array(
                'ProjetosEspeciais\Controller\Index:index',
                'ProjetosEspeciais\Controller\Helpdesk:index',
                'ProjetosEspeciais\Controller\Helpdesk:chamado',
                'ProjetosEspeciais\Controller\Helpdesk:resposta',
                'ProjetosEspeciais\Controller\Helpdesk:store',
                'ProjetosEspeciais\Controller\Helpdesk:close',
                'ProjetosEspeciais\Controller\Helpdesk:changeprioridade',
                'ProjetosEspeciais\Controller\Helpdesk:avaliar',
                'ProjetosEspeciais\Controller\Helpdesk:indicadores',
            ),
        )
    ),
    'router' => array(
        'routes' => array(
            // This defines the hostname route which forms the base
            // of each "child" route
            'projetos-especiais' => array(
                'type' => 'literal',
                 'may_terminate' => true,
                'options' => array(
                    'route' => '/projetos-especiais',
                    'defaults' => array(
                        // '__NAMESPACE__' => 'ProjetosEspeciais\Controller',
                        'controller' => 'ProjetosEspeciais\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'child_routes' => array(
                    'helpdesk' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/helpdesk',
                            'defaults' => array(
                                'controller' => 'ProjetosEspeciais\Controller\HelpDesk',
                                'action' => 'index',
                                'setor' => 2
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'open' => array(
                                'type' => 'Literal',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/open',
                                    'defaults' => array(
                                        'action' => 'store',
                                    ),
                                ),
                            ),
                            'indicadores' => array(
                                'type' => 'Literal',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/indicadores',
                                    'defaults' => array(
                                       'setor' => 2,
                                        'action' => 'indicadores',
                                    ),
                                ),
                            ),
                            'helpdesk-page' => array(
                                'type' => 'Segment',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/page[/:page]',
                                    'constraints' => array(
                                        'page' => '[0-9]+'
                                    ),
                                    'defaults' => array(
                                        'action' => 'index',
                                        'page' => 1
                                    ),
                                ),
                            ),
                               
                            'chamado' => array(
                                'type' => 'Segment',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/chamado/:chamado',
                                    'constraints' => array(
                                        'chamado' => '[0-9]+'
                                    ),
                                    'defaults' => array(
                                        'action' => 'chamado',
                                        'chamado' => 0
                                    ),
                                ),
                                'child_routes' => array(
                                    'avaliar-chamado' => array(
                                        'type' => 'Literal',
                                        'may_terminate' => true,
                                        'options' => array(
                                            'route' => '/avaliar',
                                            'defaults' => array(
                                                'action' => 'avaliar',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            'fechar' => array(
                                'type' => 'Segment',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/fechar/chamado/:chamado',
                                    'constraints' => array(
                                        'chamado' => '[0-9]+'
                                    ),
                                    'defaults' => array(
                                        'action' => 'close',
                                        'chamado' => 0
                                    ),
                                ),
                            ),
                            'changeprioridade' => array(
                                'type' => 'Literal',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/changeprioridade',
                                    'defaults' => array(
                                        'controller' => 'ProjetosEspeciais\Controller\HelpDesk',
                                        'action' => 'changeprioridade',
                                    ),
                                ),
                            ),
                            'chamado-resposta' => array(
                                'type' => 'Segment',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/chamado/:id/resposta',
                                    'constraints' => array(
                                        'id' => '[0-9]+'
                                    ),
                                    'defaults' => array(
                                        'action' => 'resposta',
                                        'id' => 0
                                    ),
                                ),
                            ),
                        )
                    ),
//                 
                )
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ProjetosEspeciais\Controller\Helpdesk' => 'ProjetosEspeciais\Controller\HelpdeskController',
            'ProjetosEspeciais\Controller\Index' => 'ProjetosEspeciais\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../../Base/view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../../Base/view/error/404.phtml',
            'error/index' => __DIR__ . '/../../Base/view/error/index.phtml',
            'partials/navigation' => __DIR__ . '/../view/partials/navigation.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
