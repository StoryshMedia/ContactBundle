<?php

namespace Smug\ContactBundle\Constants\Config\Backend;

use Smug\ContactBundle\Entity\Contact\Contact;

class ContactConstants
{
	const PAGINATION_CONFIG = [
		'fields' => ['data'],
		'model' => 'contacts'
	];

	const MAPPING = [
		'returnObject' => false,
		'class' => Contact::class
	];
}
