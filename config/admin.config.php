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
				'tabs' => array(
					'Details' => array('title', 'page_number', 'url'),
					'Comic' => array('image_file', 'transcript_html'),
					'Commentary' => array('description_html'),
				),
			),
			'atpcomic_arc' => array(
				'displayName' => 'Arc',
				'class' => 'ATPComic\Model\Arc',
				'category' => 'Comic',
				'displayColumns' => array('Url'),
				'defaultOrder' => 'name ASC',
				'tabs' => array(
					'Details' => array('name', 'url'),
					'Related Arcs' => array('parent_arc_id', 'prev_arc_id', 'next_arc_id'),
				),
			),
			'atpcomic_node' => array(
				'displayName' => 'Node',
				'class' => 'ATPComic\Model\Node',
				'category' => 'Comic',
				'displayColumns' => array('NextNodeId', 'PrevNodeId'),
				'defaultOrder' => 'page_id ASC',
				'tabs' => array(
					'Details' => array('arc_id', 'page_id'),
					'Navigation' => array('prev_node_id', 'next_node_id'),
				),
			),
		),
	),
);
