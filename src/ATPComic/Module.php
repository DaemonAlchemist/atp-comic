<?php

namespace ATPComic;

class Module extends \ATP\Module
{
	protected $_moduleName = "ATPComic";
	protected $_moduleBaseDir = __DIR__;
	
	protected function getInstallDbQueries()
	{
		return array(
			"CREATE TABLE `atpcomic_arcs` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`url` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`parent_arc_id` int(11) DEFAULT NULL,
				`next_arc_id` int(11) DEFAULT NULL,
				`prev_arc_id` int(11) DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `url_index` (`url`),
				KEY `comic_arc_parent_fk_idx` (`parent_arc_id`),
				KEY `comic_arc_next_fk_idx` (`next_arc_id`),
				KEY `comic_arc_prev_fk_idx` (`prev_arc_id`),
				CONSTRAINT `atpcomic_next_arc_fk` FOREIGN KEY (`next_arc_id`) REFERENCES `atpcomic_arcs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
				CONSTRAINT `atpcomic_parent_arc_fk` FOREIGN KEY (`parent_arc_id`) REFERENCES `atpcomic_arcs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
				CONSTRAINT `atpcomic_prev_arc_fk` FOREIGN KEY (`prev_arc_id`) REFERENCES `atpcomic_arcs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",

			"CREATE TABLE `atpcomic_pages` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`title` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`page_number` int(4) DEFAULT NULL,
				`url` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`image_file` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`description_html` longtext COLLATE utf8_unicode_ci,
				`transcript_html` longtext COLLATE utf8_unicode_ci,
				PRIMARY KEY (`id`),
				KEY `page_index` (`page_number`),
				KEY `url_index` (`url`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",

			"CREATE TABLE `atpcomic_nodes` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`arc_id` int(11) DEFAULT NULL,
				`page_id` int(11) DEFAULT NULL,
				`next_node_id` int(11) DEFAULT NULL,
				`prev_node_id` int(11) DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `arc_index` (`arc_id`),
				KEY `page_index` (`page_id`),
				KEY `comic_node_next_fk_idx` (`next_node_id`),
				KEY `comic_node_prev_fk_idx` (`prev_node_id`),
				CONSTRAINT `atpcomic_node_next_fk` FOREIGN KEY (`next_node_id`) REFERENCES `atpcomic_nodes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
				CONSTRAINT `atpcomic_node_prev_fk` FOREIGN KEY (`prev_node_id`) REFERENCES `atpcomic_nodes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
				CONSTRAINT `comic_node_arc_fk` FOREIGN KEY (`arc_id`) REFERENCES `atpcomic_arcs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
				CONSTRAINT `comic_node_page_fk` FOREIGN KEY (`page_id`) REFERENCES `atpcomic_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		);
	}
}
