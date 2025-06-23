<?php

namespace Smug\ContactBundle\Entity\Cooperation;

use Smug\Core\Service\Base\Query\QueryMapper;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\Core\Service\Base\Components\Handler\TimeHandler;

class CooperationPreparer extends QueryMapper
{
    public function prepare(array $cooperation, array $mapValues): array
    {
        $cooperation['cooperationDate'] = TimeHandler::getNewDateObject()->format('d.m.Y');

        return DataHandler::mergeArray($cooperation, $mapValues);
    }
}
