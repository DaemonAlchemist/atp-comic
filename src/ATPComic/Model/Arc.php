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
			'where' => "arc_id = ?",
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
			'where' => "arc_id = ?",
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
				'where' => 'arc_id=' . $this->id,
				'orderBy' => 'page_number ASC',
			);
			
			$node = new \ATPComic\Model\Node();
			$this->_pageNodes = $node->loadMultiple($options);
		}
		
		return $this->_pageNodes;
	}
	
	public function getSubArcs()
	{
		return $this->getAtpcomicArcsByParentArc();
	}
}
Arc::init();
