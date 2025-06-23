<?php

namespace Smug\ContactBundle\Entity\Contact;

use Smug\Core\Service\Base\Query\QueryMapper;
use Smug\Core\Service\Base\Components\Handler\DataHandler;

class ContactPreparer extends QueryMapper
{
    public function prepare(array $data, array $mapValues): array
    {
        $data['data'] = $data;

        return DataHandler::mergeArray($data, $mapValues);
    }
}
