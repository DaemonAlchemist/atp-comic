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
		
		//Get the current arc
		$arc = new \ATPComic\Model\Arc();
		$arc->loadByUrl($this->params('arc'));
		
		//Get the current page
		$page = new \ATPComic\Model\Page();
		$page->loadByUrl($this->params('pageUrl'));
		
		//Get the arc/page node
		$node = new \ATPComic\Model\Node($arc, $page);
		
		$view = new \Zend\View\Model\ViewModel(array(
			'arc' => $arc,
			'page' => $page,
			'node' => $node,
		));
		
		return $view;
	}
	
	
	public function archivesAction()
	{
		$this->init();
		
		$arcUrl = $this->params('arc');
		
		$arc = new \ATPComic\Model\Arc();
		$arcs = $arc->loadMultiple(array(
			'where' => !empty($arcUrl) ? "url = ?" : "parent_arc_id is null OR parent_arc_id = 0",
			'data' =>!empty($arcUrl) ? array($arcUrl) : array()
		));
		
		return new \Zend\View\Model\ViewModel(array(
			'arcs' => $arcs
		));
	}
}
