<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfile extends BasesfGuardUserProfile
{
	public function getFullname()
	{
		return $this->getFirstName() . ' ' . $this->getLastName();
	}
}
