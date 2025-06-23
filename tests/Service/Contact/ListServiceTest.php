<?php

namespace Smug\ContactBundle\Tests\Service\Contact;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Service\Contact\Listing\ListService;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\FrontendUserBundle\Entity\FrontendUser\FrontendUser;

class ListServiceTest extends KernelTestCase
{
	protected $container;

	private static $paginatedParams = [
		"showLogo" => false,
		"getUrl" => "/be/api/contact/get/paginated",
		"addLink" => "/contact/add",
		"editLink" => "/contact/edit/",
		"paginatorModel" => "contacts",
		"zone" => "contact",
		"limit" => 12,
		"showComment" => false,
		"commentLink" => "",
		"deleteSelected" => true,
		"batchProcessing" => false,
		"showExport" => false,
		"showImport" => false,
		"showDelete" => false,
		"deleteLink" => "",
		"paginationLimits" => [5, 10, 20, 50, 100]
	];

	private static $contactArray = [
		"id" => [
			'type' => 'string'
		],
		"firstName" => [
			'type' => 'string'
		],
		"lastName" => [
			'type' => 'string'
		],
		"email" => [
			'type' => 'string'
		],
		"fax" => [
			'type' => 'string'
		],
		"message" => [
			'type' => 'string'
		],
		"type" => [
			'type' => 'string'
		],
		"date" => [
			'type' => 'string'
		],
		"name" => [
			'type' => 'string'
		]
	];

	private static $reactionArray = [
		"id" => [
			'type' => 'string'
		],
		"subject" => [
			'type' => 'string'
		],
		"message" => [
			'type' => 'string'
		],
		"form" => [
			'type' => 'array'
		],
		"attachments" => [
			'type' => 'array'
		]
	];

	protected function setUp(): void
    {
        self::bootKernel([
			"environment" => 'test'
		  ]);
        $this->container = static::getContainer();
    }

    public function testGetSingle()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getSingle('018f3ac9-3f83-72f7-a796-4ee32816f4d9');

		$this->assertEquals($data['id'], '018f3ac9-3f83-72f7-a796-4ee32816f4d9');
		$this->assertEquals($data['type'], 'event/list');

		foreach (self::$contactArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data));
			$this->assertEquals(DataHandler::getVariableType($data[$key]), $value['type']);
		}
    }

    public function testGetSingleReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getSingle('018f3ac9-3f83-72f7-a796-4ee32816f4d9');

		$this->assertEquals($data['id'], '018f3ac9-3f83-72f7-a796-4ee32816f4d9');
		$this->assertEquals($data['type'], 'event/list');

		foreach ($data as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$contactArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$contactArray[$key]['type']);
		}
    }

    public function testGetFormReactions()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getFormReactions('018f3ac9-3f83-72f7-a796-4ee32816f4d9');

		$this->assertEquals($data[0]['id'], '018f3ac9-3fef-717d-a712-2b200373651a');

		foreach (self::$reactionArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data[0]));
			$this->assertEquals(DataHandler::getVariableType($data[0][$key]), $value['type']);
		}
    }

    public function testGetFormReactionsReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getFormReactions('018f3ac9-3f83-72f7-a796-4ee32816f4d9');

		$this->assertEquals($data[0]['id'], '018f3ac9-3fef-717d-a712-2b200373651a');

		foreach ($data[0] as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$reactionArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$reactionArray[$key]['type']);
		}
    }

    public function testGetPaginated()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getPaginated(self::$paginatedParams);

		$this->assertTrue(DataHandler::doesKeyExists('contacts', $data));
		$this->assertEquals(12, $data['limit']);
		$this->assertEquals(1, $data['page']);
    }
}

