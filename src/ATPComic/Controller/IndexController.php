<?php

namespace ATPComic\Controller;

class IndexController extends \ATPCore\Controller\AbstractController
{
    use \ATPComic\ApiTrait;

	public function init()
	{
        $this->cacheFor(24*60*60);
	}

	public function pageAction()
	{
		$this->init();
		
		//Get the params
		$pageUrl = $this->params('pageUrl');
		
        //Get the page Id from the url
        $pageId = $this->api("page", [
            'columns' => 'id',
            'url' => $pageUrl
        ])[0]->id;

        //Get the page details from the REST api
        $page = $this->api("page/" . $pageId . "/details");

        //Make sure the page is active
        if(!$page->enabled)
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        //Save the current page in the session
		$this->remember->currentComicPage = $page->url;
		
		$view = new \Zend\View\Model\ViewModel();
        $view->page = $page;
        //echo "<pre>";print_r(json_encode($view->page));die();
		
		//Create the page widget
		$comicPage = new \ATPComic\View\Widget\Page();
        $comicPage->page = $view->page;
        $comicPage->showComments = true;
		$view->addChild($comicPage, 'comicPage');		
		
		return $view;
	}
	
	public function bookmarkAction()
	{
        $this->noCache();

		if(isset($this->remember->currentComicPage))
		{
			$this->redirect()->toRoute('comic/page', ['pageUrl' => $this->remember->currentComicPage]);
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

        $arcId = $this->api("arc", ['url' => $arcUrl])[0]->id;

        $arc = $this->api('arc/' . $arcId . '/details');

		return new \Zend\View\Model\ViewModel(array(
			'arc' => $arc,
		));
	}

	public function feedAction()
    {
        $this->init();

        $arcUrl = $this->params('arc');

        $pages = $this->api('page', ['enabled' => true, 'sort' => 'postDate DESC', 'perPage' => 10]);

        $view = new \Zend\View\Model\ViewModel(array(
            'arc' => $arcUrl,
            'pages' => $pages
        ));

        $view->setTerminal(true);

        return $view;
    }
}
