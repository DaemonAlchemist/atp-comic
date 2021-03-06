<?php

namespace ATPComic\Controller;

class APIController extends \ATPCore\Controller\AbstractController
{
	public function init()
	{
	}

	public function movePageAction()
	{
		//Make sure the user is logged in first
		if(!\ATPAdmin\Auth::isLoggedIn())
		{
			$this->getResponse()->setStatusCode(401);
			return;
		}
	
		//Get the node
		$nodeId = $this->params()->fromPost('nodeId');
		$node = new \ATPComic\Model\Node();
		$node->loadById($nodeId);
		
		//Get the arc
		$arc = $node->arc;
		
		//Get the direction
		$direction = $this->params()->fromPost('direction');
		
		//Move node
		$result = false;
		$prevPageName = "&nbsp;";
		$nextPageName = "&nbsp;";
		if($direction == 'prev' && !$node->isFirst())
		{
			//Get prev node
			$prevNode = $node->prevNode(false);
			
			//Get the new previous page name
			if(!$prevNode->isFirst())
			{
				$prevPageName = $prevNode->prevNode(false)->page->title;
			}
			
			//Update page numbers
			$prevNode->pageNumber++;
			$node->pageNumber--;
			
			//Update next page name
			$nextPageName = $prevNode->page->title;
			
			//Save the nodes
			$prevNode->save();
			$node->save();
			
			$result = true;
		}
		else if($direction == 'next' && !$node->isLast(false))
		{
			//Get prev node
			$nextNode = $node->nextNode(false);
			
			//Get the new next page name
			if(!$nextNode->isLast(false))
			{
				$nextPageName = $nextNode->nextNode(false)->page->title;
			}
			
			//Update page numbers
			$nextNode->pageNumber--;
			$node->pageNumber++;
			
			//Update next page name
			$prevPageName = $nextNode->page->title;
			
			//Save the nodes
			$nextNode->save();
			$node->save();
			
			$result = true;
		}
		
		echo json_encode(array(
			"result" => $result,
			"direction" => $direction,
			"prevPageName" => $prevPageName,
			"nextPageName" => $nextPageName,
		));
		die();
	}
	
	public function releasePagesAction()
	{
		$releaseSchedule = new \ATPComic\Model\ReleaseSchedule();
		$newPages = $releaseSchedule->run();
		foreach($newPages as $page)
		{
			echo "The webcomic page '{$page->title}' has been released.\n";
		}
	}
}
