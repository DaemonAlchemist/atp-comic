<?php

namespace ATPComic\Model;

require_once("Arc.php");

class Commentary extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return $this->page->title . ' by ' . $this->user->username;
	}
}
Commentary::init();
