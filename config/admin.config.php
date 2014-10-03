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
					'Details' => array('title', 'url', 'post_date', 'is_active'),
					'Comic' => array('image_file', 'transcript_html'),
					'Commentary' => array('description_html'),
				),
				'customTabs' => array(
					'Story Arcs' => 'atp-comic/admin/edit/page/arcs-tab.phtml',
					'Move Page' => 'atp-comic/admin/edit/page/move-tab.phtml',
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
					'Related Arcs' => array('parent_arc_id', 'sub_arc_name', 'prev_arc_id', 'next_arc_id'),
				),
				'customTabs' => array(
					'Pages' => 'atp-comic/admin/edit/arc/pages-tab.phtml',
				),
			),
			'atpcomic_node' => array(
				'displayName' => 'Node',
				'class' => 'ATPComic\Model\Node',
				'category' => 'Comic',
				'displayColumns' => array(),
				'defaultOrder' => 'page_id ASC',
				'tabs' => array(
					'Details' => array('arc_id', 'page_id', 'page_number', 'is_active'),
				),
			),
		),
		'parameters' => array(
			'comic-default-arc' => array(
				'displayName' => 'Default Story Arc',
				'group' => 'Comic',
				'type' => 'ModelSelect',
				'default' => '',
				'options' => array(
					'className' => 'ATPComic\Model\Arc',
				),
			),
			'comic-root-arc-name' => array(
				'displayName' => 'Root Arc Name',
				'group' => 'Comic',
				'type' => 'Text',
				'default' => 'Comic',
			),
			'comic-bookmark-text' => array(
				'displayName' => 'Bookmark Link Text',
				'group' => 'Comic',
				'type' => 'Text',
				'default' => 'Continue where you left off.',
			),
			'comic-first-page-text' => array(
				'displayName' => 'First Page Link Text',
				'group' => 'Comic',
				'type' => 'Text',
				'default' => 'New reader?  Start here.',
			),
			'comic-show-archive-page-names' => array(
				'displayName' => 'Show Archive Page Names',
				'group' => 'Comic',
				'type' => 'Boolean',
				'default' => true,
			),
			'comic-show-nav-links-top' => array(
				'displayName' => 'Show Top Nav Links',
				'group' => 'Comic',
				'type' => 'Boolean',
				'default' => true,
			),
			'comic-show-nav-links-bottom' => array(
				'displayName' => 'Show Bottom Nav Links',
				'group' => 'Comic',
				'type' => 'Boolean',
				'default' => true,
			),
			'comic-show-archive-dropdown' => array(
				'displayName' => 'Show Archive Dropdown',
				'group' => 'Comic',
				'type' => 'Boolean',
				'default' => true,
			),
			'comic-show-transcripts' => array(
				'displayName' => 'Show Page Transcripts',
				'group' => 'Comic',
				'type' => 'Boolean',
				'default' => true,
			),
			'comic-use-adsense' => array(
				'displayName' => 'Include Adsense Ads',
				'group' => 'Comic',
				'type' => 'Boolean',
				'default' => true,
			),
		),
	),
);
