<?php

namespace ATPComic\Controller;

class IndexController extends \ATPCore\Controller\AbstractController
{
	public function init()
	{
	}

	public function pageAction()
	{
		$this->init();
		
		$arc = new \ATPComic\Model\Arc();
		$arc->loadByUrl($this->params('arc'));
		
		$page = new \ATPComic\Model\Page();
		$page->loadByUrl($this->params('pageUrl'));
		
		$node = new \ATPComic\Model\Node($arc, $page);
		
		return new \Zend\View\Model\ViewModel(array(
			'arc' => $arc,
			'page' => $page,
			'node' => $node,
		));
	}
	
	
	public function archivesAction()
	{
		$this->init();
	}
}
