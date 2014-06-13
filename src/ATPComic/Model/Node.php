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
	
	public function displayName()
	{
		return $this->arc->displayName() . " - " . $this->page->displayName();
	}
}
Node::init();
