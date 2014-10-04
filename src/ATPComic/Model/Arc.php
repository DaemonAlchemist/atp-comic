<?php

namespace ATPComic\Model;

require_once("Node.php");

class Arc extends \ATP\ActiveRecord
{
	private $_pageNodes = null;

	public function displayName()
	{
		return $this->name;
	}
	
	public function fullName()
	{
		return $this->parentArc->id ? $this->displayName() . " / " . $this->parentArc->fullName() : $this->displayName();
	}
	
	public function firstNode()
	{
		$node = new \ATPComic\Model\Node();
		$nodes = $node->loadMultiple(array(
			'where' => "arc_id = ? and is_active=1",
			'orderBy' => 'page_number ASC',
			'limit' => 1,
			'data' => array($this->id)
		));
		
		return count($nodes) > 0 ? $nodes[0] : null;
	}
	
	public function lastNode()
	{
		$node = new \ATPComic\Model\Node();
		$nodes = $node->loadMultiple(array(
			'where' => "arc_id = ? and is_active=1",
			'orderBy' => 'page_number DESC',
			'limit' => 1,
			'data' => array($this->id)
		));
		
		return count($nodes) > 0 ? $nodes[0] : null;
	}
	
	public function hasNextArc()
	{
		return $this->nextArc->id;
	}
	
	public function hasPrevArc()
	{
		return $this->prevArc->id;
	}
	
	public static function getRootArcs()
	{
		$options = array(
			'where' => 'parent_arc_id is null or parent_arc_id=0'
		);
		$arc = new static();
		return $arc->loadMultiple($options);
	}
	
	public function getPageNodes()
	{
		if(is_null($this->_pageNodes))
		{		
			$options = array(
				'where' => 'arc_id = ? and is_active=1',
				'orderBy' => 'page_number ASC',
				'data' => array($this->id),
			);
			
			$node = new \ATPComic\Model\Node();
			$this->_pageNodes = $node->loadMultiple($options);
		}
		
		return $this->_pageNodes;
	}
	
	public function getSubArcs()
	{
		return array_filter((array)$this->getAtpcomicArcsByParentArc(), function($arc){
			return count($arc->getPageNodes()) > 0;
		});
	}
}
Arc::init();
