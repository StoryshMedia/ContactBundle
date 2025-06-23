<?php

namespace Smug\ContactBundle\Constants\Config\Backend;

use Smug\ContactBundle\Entity\Contact\Contact;
use Smug\ContactBundle\Entity\Contact\ContactReaction;
use Smug\ContactBundle\Entity\Media\MediaContactReactionAssociation;

/**
 * Class ContactReactionConstants
 * @package Smug\ContactBundle\Constants\Contact
 */
class ContactReactionConstants
{
	const MAPPING = [
        'class' => ContactReaction::class,
        'returnObject' => false,
        'mapValues' => [
            [
                'identifier' => 'contact',
                'class' => Contact::class
            ]
        ],
        'media' => [
            'class' => MediaContactReactionAssociation::class,
            'function' => 'setContactReaction'
        ]
    ];
}
