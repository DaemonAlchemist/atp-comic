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
							'route'    => '/page/:pageUrl',
							'defaults' => array(
								'controller'    => 'atp-comic-index',
								'action'		=> 'page',
							),
						),
					),
                    //TODO:  ---- Remove this when Google juice has been transferred to new pages----
                    'pageOLD' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:arc/:number/:pageUrl',
                            'defaults' => array(
                                'controller'    => 'atp-comic-index',
                                'action'		=> 'page',
                            ),
                        ),
                    ),
					'bookmark' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/bookmark',
							'defaults' => array(
								'controller' => 'atp-comic-index',
								'action' => 'bookmark',
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
                    'feed' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/rss[/:arc]',
                            'defaults' => array(
                                'controller'    => 'atp-comic-index',
                                'action'		=> 'feed',
                            ),
                        ),
                    ),
					'api' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/api/[:action]',
							'defaults' => array(
								'controller' => 'atp-comic-api',
							),
						),
					),
				),
			),
        ),
    ),
	 'console' => array(
        'router' => array(
            'routes' => array(
                'release-pages' => array(
                    'options' => array(
                        'route'    => 'release-comic-pages [arc]',
                        'defaults' => array(
                            'controller' => 'atp-comic-api',
                            'action'     => 'release-pages',
                        )
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'atp-comic-index' => 'ATPComic\Controller\IndexController',
			'atp-comic-api' => 'ATPComic\Controller\APIController',
        ),
    ),
);
