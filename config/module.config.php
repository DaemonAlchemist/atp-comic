<?php

return array(
	'admin' => array(
		'models' =>array(
			'atpcomic_page' => array(
				'displayName' => 'Page',
				'class' => 'ATPComic\Model\Page',
				'category' => 'Comic',
				'displayColumns' => array('Url'),
				'defaultOrder' => 'page_number DESC',
			),
			'atpcomic_arc' => array(
				'displayName' => 'Arc',
				'class' => 'ATPComic\Model\Arc',
				'category' => 'Comic',
				'displayColumns' => array('Url'),
				'defaultOrder' => 'name ASC',
			),
			'atpcomic_node' => array(
				'displayName' => 'Node',
				'class' => 'ATPComic\Model\Node',
				'category' => 'Comic',
				'displayColumns' => array('NextNodeId', 'PrevNodeId'),
				'defaultOrder' => 'page_id ASC',
			),
		),
	),
    'router' => array(
        'routes' => array(
            'comic_page' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/comic[/:arc[/:pageNum/:pageUrl]]',
                    'defaults' => array(
                        'controller'    => 'ATPComic\Controller\IndexController',
						'action'		=> 'page',
                    ),
                ),
            ),
            'comic_archives' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/comic/archives[/:arc[/children]]',
                    'defaults' => array(
                        'controller'    => 'ATPComic\Controller\IndexController',
						'action'		=> 'archives',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ATPComic\Controller\IndexController' => 'ATPComic\Controller\IndexController'
        ),
    ),
);
