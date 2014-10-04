<?php

namespace ATPComic\Model;

require_once("Arc.php");

class ReleaseSchedule extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return $this->arc->name;
	}
	
	public function run()
	{
		$pages = array();
		foreach($this->loadMultiple() as $schedule)
		{
			//Check the day of the week before releasing page
			$day = strtolower(date("l"));
			if(!($schedule->$day)) continue;
			
			//Get the schedules arc id
			$arcId = $schedule->arcId;
			
			//Get the next node to release
			$options = array(
				'where' => 'arc_id = ? and is_active = 0',
				'orderBy' => 'page_number ASC',
				'limit 1',
				'data' => array($arcId)
			);
			
			$node = new \ATPComic\Model\Node();
			$nodes = $node->loadMultiple($options);
			$node = count($nodes) > 0 ? $nodes[0] : null;
			
			//If there are no more pages, then skip this arc
			if(is_null($node)) continue;
			
			//Release the page
			$page = $node->page;
			$page->isActive = 1;
			$page->postDate = date('Y-m-d H:i:s');
			$page->save();
			
			$pages[] = $page;
		}
		
		return $pages;
	}
}
ReleaseSchedule::init();
