<?php

namespace ATPComic\Model;

require_once("Arc.php");

class Commentary extends \ATP\ActiveRecord
{
    public function __construct()
    {
        parent::__construct();

        //Necessary to make sure the admin user class is loaded
        $user = new \ATPAdmin\Model\User();
    }

	public function displayName()
	{
		return "'" . $this->title . "' for '" . $this->page->title . "' by " . $this->user->username;
	}
}
Commentary::init();
