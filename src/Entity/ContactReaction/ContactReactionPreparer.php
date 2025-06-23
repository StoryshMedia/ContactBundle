<?php

namespace Smug\ContactBundle\Entity\ContactReaction;

use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\Core\Service\Base\Query\QueryMapper;

class ContactReactionPreparer extends QueryMapper
{
    public function prepare(array $reaction, array $mapValues): array
    {
        return DataHandler::mergeArray($reaction, $mapValues);
    }
}
