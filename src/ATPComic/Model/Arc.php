<?php

namespace ATPComic\Model;

class Arc extends \ATP\ActiveRecord
{
	protected function setup()
	{
		$this->setTableNamespace('comic');
	}
	
	public function displayName()
	{
		return $this->name;
	}
}
Arc::init();
