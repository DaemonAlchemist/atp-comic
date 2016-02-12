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

    public function parentArcs()
    {
        return $this->parentArc->id
            ? array_merge($this->parentArc->parentArcs(), [$this->parentArc])
            : [];
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
	
	public function getSubArcs($filterEmpty = true)
	{
        $arcs = (array)$this->getAtpcomicArcsByParentArc();
        usort($arcs, function($a, $b){
            return $a->sortOrder - $b->sortOrder;
        });
		return $filterEmpty
            ?array_filter($arcs, function($arc){
			    return count($arc->getPageNodes()) > 0;
		    })
            : $arcs;
	}
}
Arc::init();
