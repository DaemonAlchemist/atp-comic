<?php

namespace ATPComic\Model;

require_once("Page.php");
require_once("Arc.php");

class Node extends \ATP\ActiveRecord
{
	private $_nextNode = null;
	private $_prevNode = null;

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
		$page = $this->page->displayName();
		$arc = $this->arc->displayName();
		return  "The \"{$page}\" page in the story arc \"{$arc}\"";
	}
	
	public function getRoutingData()
	{
		return array(
			'arc'		=> $this->arc->url,
			'pageNum'	=> $this->pageNumber,
			'pageUrl'	=> $this->page->url,
		);		
	}

	public function prevNode()
	{
		if(is_null($this->_prevNode))
		{
			$options = array(
				'where' => 'arc_id = ? AND page_number < ? AND is_active = 1',
				'orderBy' => 'page_number DESC',
				'limit' => 1,
				'data' => array($this->arcId, $this->pageNumber),
			);
			
			$nodes = $this->loadMultiple($options);
			$this->_prevNode = count($nodes) > 0 ? $nodes[0] : null;
		}
		
		return $this->_prevNode;
		
	}
	
	public function nextNode()
	{
		if(is_null($this->_nextNode))
		{
			$options = array(
				'where' => 'arc_id = ? AND page_number > ? AND is_active = 1',
				'orderBy' => 'page_number ASC',
				'limit' => 1,
				'data' => array($this->arcId, $this->pageNumber),
			);
			
			$nodes = $this->loadMultiple($options);
			$this->_nextNode = count($nodes) > 0 ? $nodes[0] : null;
		}
		
		return $this->_nextNode;
		
	}

	public function isLast()
	{
		return is_null($this->nextNode());
	}
	
	public function isFirst()
	{
		return $this->pageNumber == 1;
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
