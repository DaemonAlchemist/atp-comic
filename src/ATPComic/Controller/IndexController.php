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
		
		//Get the params
		$arcId = $this->params('arc');
		$pageUrl = $this->params('pageUrl');
		
		//Get the current arc
		$arc = new \ATPComic\Model\Arc();
		$arc->loadByUrl($arcId);
		
		//Get the current page
		$page = new \ATPComic\Model\Page();
		$page->loadByUrl($pageUrl);
		
		//Make sure the page is active
		if(!$page->isActive)
		{
			$this->getResponse()->setStatusCode(404);
			return;
		}
		
		//Get the arc/page node
		$node = new \ATPComic\Model\Node($arc, $page);
		
		//Save the current page in the session
		$this->remember->currentComicPage = $node->id;
		
		$view = new \Zend\View\Model\ViewModel();
		$view->node = $node;
		
		//Create the page widget
		$comicPage = new \ATPComic\View\Widget\Page();
		$comicPage->node = $node;
		$view->addChild($comicPage, 'comicPage');		
		
		return $view;
	}
	
	public function bookmarkAction()
	{
		if(isset($this->remember->currentComicPage))
		{
			$nodeId = $this->remember->currentComicPage;
			$node = new \ATPComic\Model\Node();
			$node->loadById($nodeId);
			$this->redirect()->toRoute('comic/page', $node->getRoutingData());
		}
		else
		{
			$this->redirect()->toRoute('home');
		}
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
