<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Entry\Controller\Entry' => 'Entry\Controller\EntryController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'entry' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/entry[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Entry\Controller\Entry',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    
    'view_manager' => array(
        'template_path_stack' => array(
            'entry' => __DIR__ . '/../view',
        ),
    ),
);