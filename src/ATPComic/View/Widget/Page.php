<?php

namespace ATPComic\View\Widget;

class Page extends \ATPCore\View\Widget
{
	protected $_template = "atp-comic/widget/page.phtml";
	private $_links = null;
	
	protected function init()
	{
		$this->_links = new \ATPComic\View\Widget\NavLinks();
		$this->addChild($this->_links, 'navLinks');
	}

	protected function setPage($page)
    {
        $this->_links->page = $page;
    }
}
