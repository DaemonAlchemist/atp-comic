<?php

return array(
	'admin' => array(
		'models' =>array(
			'comic_page' => array(
				'displayName' => 'Page',
				'class' => 'ATPComic\Model\Page',
				'category' => 'Comic',
				'displayColumns' => array('PageNumber', 'Title'),
				'defaultOrder' => 'page_number DESC',
			),
			'comic_arc' => array(
				'displayName' => 'Arc',
				'class' => 'ATPComic\Model\Arc',
				'category' => 'Comic',
				'displayColumns' => array('Name', 'Url'),
				'defaultOrder' => 'name ASC',
			),
			'comic_node' => array(
				'displayName' => 'Node',
				'class' => 'ATPComic\Model\Node',
				'category' => 'Comic',
				'displayColumns' => array('ArcId', 'PageId', 'NextNodeId', 'PrevNodeId'),
				'defaultOrder' => 'page_id ASC',
			),
		),
	),
    'router' => array(
        'routes' => array(
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ATPComic\Controller\IndexController' => 'ATPComic\Controller\IndexController'
        ),
    ),
);
