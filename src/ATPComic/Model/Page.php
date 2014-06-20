<?php

namespace ATPComic\Model;

class Page extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return "({$this->pageNumber}){$this->title}";
	}
}
Page::init();
