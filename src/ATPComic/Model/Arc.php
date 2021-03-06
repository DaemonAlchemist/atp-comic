<?php

namespace ATPComic\Model;

require_once("Node.php");

class Arc extends \ATP\ActiveRecord
{
	private $_pageNodes = null;

	public function displayName()
	{
		return $this->fullName();
	}
	
	public function fullName()
	{
		return $this->parentArc->id ? $this->parentArc->fullName() . ' - ' . $this->name : $this->name;
	}

    public function parentArcs()
    {
        return $this->parentArc->id
            ? array_merge($this->parentArc->parentArcs(), [$this->parentArc])
            : [];
    }
	
	public function firstNode($activeOnly = true)
	{
		$node = new \ATPComic\Model\Node();
		$nodes = $node->loadMultiple(array(
			'where' => $activeOnly ? "arc_id = ? and is_active=1" : "arc_id = ?",
			'orderBy' => 'page_number ASC',
			'limit' => 1,
			'data' => array($this->id)
		));
		
		return count($nodes) > 0 ? $nodes[0] : null;
	}
	
	public function lastNode($activeOnly = true)
	{
		$node = new \ATPComic\Model\Node();
		$nodes = $node->loadMultiple(array(
            'where' => $activeOnly ? "arc_id = ? and is_active=1" : "arc_id = ?",
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
	
	public function getPageNodes($dir = "ASC", $limit = null)
	{
		if(is_null($this->_pageNodes))
		{		
			$options = array(
				'where' => 'arc_id = ? and is_active=1',
				'orderBy' => "page_number $dir",
				'data' => array($this->id),
			);
            if($limit) {
                $options['limit'] = $limit;
            }
			
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
