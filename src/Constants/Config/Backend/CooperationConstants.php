<?php

namespace Smug\ContactBundle\Constants\Config\Backend;

use Smug\ContactBundle\Entity\Cooperation\Cooperation;

class CooperationConstants
{
	const PAGINATION_CONFIG = [
		'fields' => [],
		'model' => 'cooperations'
	];

	const ADD_CONFIG = [
		'returnObject' => false,
		'class' => Cooperation::class
	];
}
