<?php

return array(
    'router' => array(
        'routes' => array(
			'comic' => array(
				'type' => 'literal',
				'options' => array(
					'route' => '/comic',
					'defaults' => array(
						'controller' => 'atp-comic-index',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'page' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/:arc[/:pageNum/:pageUrl]',
							'defaults' => array(
								'controller'    => 'atp-comic-index',
								'action'		=> 'page',
							),
						),
					),
					'archives' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/archives[/:arc[/:children]]',
							'defaults' => array(
								'controller'    => 'atp-comic-index',
								'action'		=> 'archives',
								'children'		=> null,
							),
						),
					),
				),
			),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'atp-comic-index' => 'ATPComic\Controller\IndexController'
        ),
    ),
);