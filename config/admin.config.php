<?php

return array(
	'admin' => array(
		'models' =>array(
			'atpcomic_page' => array(
				'displayName' => 'Page',
				'class' => 'ATPComic\Model\Page',
				'category' => 'Comic',
				'displayColumns' => array('Url'),
				'defaultOrder' => 'id DESC',
				'tabs' => array(
					'Details' => array('title', 'url', 'post_date'),
					'Comic' => array('image_file', 'transcript_html'),
					'Commentary' => array('description_html'),
				),
				'customTabs' => array(
					'Story Arcs' => 'atp-comic/admin/edit/page/arcs-tab.phtml',
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
				'customTabs' => array(
					'Pages' => 'atp-comic/admin/edit/arc/pages-tab.phtml',
				),
			),
			'atpcomic_node' => array(
				'displayName' => 'Node',
				'class' => 'ATPComic\Model\Node',
				'category' => 'Comic',
				'displayColumns' => array('NextNodeId', 'PrevNodeId'),
				'defaultOrder' => 'page_id ASC',
				'tabs' => array(
					'Details' => array('arc_id', 'page_id', 'page_number'),
					'Navigation' => array('prev_node_id', 'next_node_id'),
				),
			),
		),
		'parameters' => array(
			'comic-default-arc' => array(
				'identifier' => 'Default Story Arc',
				'group' => 'Comic',
				'type' => 'ModelSelect',
				'default' => '',
				'options' => array(
					'className' => 'ATPComic\Model\Arc',
				),
			),
		),
	),
);
