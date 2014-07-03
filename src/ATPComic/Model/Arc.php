<?php

namespace ATPComic\Model;

require_once("Node.php");

class Arc extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return $this->name;
	}
	
	public function fullName()
	{
		return $this->parentArc->id ? $this->parentArc->fullName() . " - " . $this->displayName() : $this->displayName();
	}
	
	public function firstNode()
	{
		$node = new \ATPComic\Model\Node();
		$nodes = $node->loadMultiple(array(
			'where' => "arc_id = ? AND prev_node_id IS NULL",
			'data' => array($this->id)
		));
		
		return count($nodes) > 0 ? $nodes[0] : null;
	}
	
	public function lastNode()
	{
		$node = new \ATPComic\Model\Node();
		$nodes = $node->loadMultiple(array(
			'where' => "arc_id = ? AND next_node_id IS NULL",
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
}
Arc::init();
