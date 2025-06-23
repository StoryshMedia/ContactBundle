<?php

namespace Smug\ContactBundle\Constants\Config\Backend;

use Smug\ContactBundle\Entity\Cooperation\CooperationPartner;

class CooperationPartnerConstants
{
	const PAGINATION_CONFIG = [
		'fields' => [],
		'model' => 'partners'
	];

	const ADD_CONFIG = [
		'returnObject' => true,
		'class' => CooperationPartner::class
	];
}
