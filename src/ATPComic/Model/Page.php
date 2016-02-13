<?php

namespace ATPComic\Model;

require_once("Arc.php");
require_once("Commentary.php");

class Page extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return $this->title;
	}
	
	public function postSave()
	{
		if(isset($this->arcAssignments))
		{
			$newArcIds = $this->arcAssignments;
			$nodes = (array)$this->getNodes();
			
			//Determine nodes to delete
			$nodesToDelete = array_filter($nodes, function($node) use ($newArcIds) {
				return !in_array($node->arcId, $newArcIds);
			});
			
			//Determine arcs to add
			$arcsToAdd = array_filter($newArcIds, function($id) use ($nodes) {
				foreach($nodes as $node)
				{
					if($node->arcId == $id) return false;
				}
				return true;
			});

			//Delete unneeded nodes
			foreach($nodesToDelete as $node)
			{
				//Delete the node
				$node->delete();
				
				//Update page numbers on subsequent pages
				$db = $node->getAdapter();
				$sql = "UPDATE atpcomic_nodes SET page_number = page_number-1 WHERE page_number > ? AND arc_id = ?";
				$db->query($sql, array($node->pageNumber, $node->arcId));
			}
			
			//Add new arcs
			foreach($arcsToAdd as $arcId)
			{			
				//Get the last node in the arc
				$arc = new \ATPComic\Model\Arc();
				$arc->loadById($arcId);
				$lastNode = $arc->lastNode();
			
				$newNode = new \ATPComic\Model\Node();
				$newNode->arc = $arc;
				$newNode->page = $this;
				$newNode->pageNumber = $lastNode ? $lastNode->pageNumber + 1 : 1;
				$newNode->isActive = $this->isActive;
			
				$newNode->save();
			}
		}
		
		//Update active flag on nodes
		foreach($this->getNodes() as $node)
		{
			$node->isActive = $this->isActive;
			$node->save();
		}
	}
	
	public function getNodes()
	{
		return $this->getAtpcomicNodesByPage();
	}
	
	public function belongsToArc($arc)
	{
		foreach($this->getAtpcomicNodesByPage() as $node)
		{
			if($arc->id == $node->arcId) return true;
		}
		
		return false;
	}
	
	public function commentaries()
	{
		$commentaries = $this->getAtpcomicCommentariesByPage()->toArray();

		usort(
			$commentaries,
			function($a, $b) {
				return $a->sortOrder - $b->sortOrder;
			}
		);
		return $commentaries;
	}
}
Page::init();
