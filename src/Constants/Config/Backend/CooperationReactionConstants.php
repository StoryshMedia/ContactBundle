<?php

namespace Smug\ContactBundle\Constants\Config\Backend;

use Smug\ContactBundle\Entity\Cooperation\Cooperation;
use Smug\ContactBundle\Entity\CooperationReaction\CooperationReaction;
use Smug\ContactBundle\Entity\Media\MediaCooperationReactionAssociation;

class CooperationReactionConstants
{
	const MAPPING = [
        'class' => CooperationReaction::class,
        'returnObject' => false,
        'mapValues' => [
            [
                'identifier' => 'cooperation',
                'class' => Cooperation::class
            ]
        ],
        'media' => [
            'class' => MediaCooperationReactionAssociation::class,
            'function' => 'setCooperationReaction'
        ]
    ];
}
