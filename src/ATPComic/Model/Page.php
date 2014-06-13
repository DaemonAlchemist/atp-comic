<?php

namespace ATPComic\Model;

class Page extends \ATP\ActiveRecord
{
	protected function setup()
	{
		$this->setTableNamespace('comic');
	}
	
	public function displayName()
	{
		return "({$this->pageNumber}){$this->title}";
	}
}
Page::init();
