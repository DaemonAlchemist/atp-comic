<?php

namespace ATPComic\Controller;

class APIController extends \ATPCore\Controller\AbstractController
{
	public function init()
	{
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
