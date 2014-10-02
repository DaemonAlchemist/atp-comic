<?php

namespace ATPComic\View\Helper;

class FirstComicPageLink extends \ATP\View\Helper
{
	public function __invoke()
	{
		$arcId = $this->getView()->siteParam('comic-default-arc');
		$arc = new \ATPComic\Model\Arc();
		$arc->loadById($arcId);
		
		$node = $arc->firstNode();
		
		return $this->getView()->url('comic/page', $node->getRoutingData());
	}
}
