<?php

namespace Smug\ContactBundle\Controller\Frontend\Api\Contact;

use Smug\ContactBundle\Entity\Contact\Contact;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\FrontendBundle\Controller\Frontend\Api\Base\FeBaseController;
use Smug\Core\Service\Base\Components\Provider\DataProvider\TimeProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Smug\Core\Service\Base\Components\Handler\TimeHandler;
use Smug\Core\Service\Base\Service\AddBaseService;

class DataController extends FeBaseController
{
    #[Route(
        '/fe/api/contact',
        name: 'fe_simple_contact_form',
        methods: ['POST'],
    )]
    public function contactAction(Request $request, AddBaseService $service): JsonResponse
    {
        $this->context->buildFromRequest(
            $request,
            Contact::class
        );

        if (DataHandler::isEmpty($this->context->getRequestData())) {
            return $this->prepareReturn([
                'success' => false,
                'message' => 'Not Data permitted'
            ]);
        }

        if ($this->context->getRequestData()['fax'] ?? '' !== '') {
            return $this->prepareReturn([
                'success' => false,
                'message' => 'Bot detected'
            ]);
        }

        $this->context->updateData('type', (DataHandler::doesKeyExists('HTTP_REFERER', $_SERVER)) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REMOTE_ADDR']);
        $this->context->updateData('date', TimeHandler::getFormatDate(TimeHandler::getNewDateObject(), TimeProvider::DATE_TIME_OUTPUT_FORMAT));

        $add = $service->add($this->context);

        if ($add['success'] === true) {
           
        }

        return $this->prepareReturn($add);
    }
}