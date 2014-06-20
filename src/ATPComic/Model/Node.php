<?php

namespace ATPComic\Model;

require_once("Page.php");
require_once("Arc.php");

class Node extends \ATP\ActiveRecord
{
	protected function setup()
	{
		$this->setTableNamespace('comic');
	}
	
	public function __construct($arc = null, $page = null)
	{
		parent::__construct();
		
		if(!is_null($arc) && !is_null($page))
		{
			$nodes = $this->loadMultiple(array(
				'where' => "arc_id = ? AND page_id = ?",
				'data' => array($arc->id, $page->id)
			));
			
			$this->setFrom($nodes[0]);
		}
	}
	
	public function displayName()
	{
		return $this->arc->displayName() . " - " . $this->page->displayName();
	}
	
	public function fullUrl()
	{
		$arc = $this->arc->url;
		$number = $this->page->pageNumber;
		$page = $this->page->url;
		
		return "comic/{$arc}/{$number}/{$page}";
	}

	public function isLastNode()
	{
		return !($this->nextNode->id);
	}
	
	public function isFirstNode()
	{
		return !($this->prevNode->id);
	}
	
	public function hasNextArc()
	{
		return $this->arc->nextArc->id;
	}
	
	public function hasPrevArc()
	{
		return $this->arc->prevArc->id;
	}
}
Node::init();
