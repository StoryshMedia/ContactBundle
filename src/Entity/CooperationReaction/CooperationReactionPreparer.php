<?php

namespace Smug\ContactBundle\Entity\CooperationReaction;

use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\Core\Service\Base\Components\Handler\TimeHandler;
use Smug\Core\Service\Base\Query\QueryMapper;

class CooperationReactionPreparer extends QueryMapper
{
    public function prepare(array $reaction, array $mapValues): array
    {
        $reaction['reactionDate'] = TimeHandler::getNewDateObject()->format('d.m.Y');

        return DataHandler::mergeArray($reaction, $mapValues);
    }
}
