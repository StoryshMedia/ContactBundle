<?php

namespace Smug\ContactBundle\Tests\Service\Cooperation;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Service\Cooperation\Listing\ListService;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\FrontendUserBundle\Entity\FrontendUser\FrontendUser;

class ListServiceTest extends KernelTestCase
{
	protected $container;

	private static $paginatedParams = [
		"showLogo" => false,
		"getUrl" => "/be/api/cooperation/get/paginated",
		"addLink" => "/cooperation/add",
		"editLink" => "/cooperation/edit/",
		"paginatorModel" => "cooperations",
		"zone" => "cooperation",
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

	private static $cooperationArray = [
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
		"personDetail" => [
			'type' => 'string'
		],
		"message" => [
			'type' => 'string'
		],
		"cooperationDate" => [
			'type' => 'string'
		],
		"hash" => [
			'type' => 'string'
		],
		"reason" => [
			'type' => 'string'
		],
		"name" => [
			'type' => 'string'
		],
		"partner" => [
			'type' => 'array'
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
		"reactionDate" => [
			'type' => 'string'
		],
		"type" => [
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

		$data = $listService->getSingle('018f3ac9-420b-7226-81b6-404e3861c929');

		$this->assertEquals($data['id'], '018f3ac9-420b-7226-81b6-404e3861c929');
		$this->assertEquals($data['email'], 'a.voss@business-unicorns.de');

		foreach (self::$cooperationArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data));
			$this->assertEquals(DataHandler::getVariableType($data[$key]), $value['type']);
		}
    }

    public function testGetSingleReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getSingle('018f3ac9-420b-7226-81b6-404e3861c929');

		$this->assertEquals($data['id'], '018f3ac9-420b-7226-81b6-404e3861c929');
		$this->assertEquals($data['email'], 'a.voss@business-unicorns.de');

		foreach ($data as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$cooperationArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$cooperationArray[$key]['type']);
		}
    }

    public function testGetSingleWithFalseId()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getSingle('018f3ac9-420b-7226-81b6-404e3861c922');

		$this->assertFalse($data['success']);
		$this->assertEquals($data['message'], 'No data found for identifier 018f3ac9-420b-7226-81b6-404e3861c922');
    }

    public function testGetReplies()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getReplies('018f3ac9-420d-7061-a921-f16f3733d8de');

		$this->assertEquals($data[0]['id'], '018f3ac9-42dd-707f-ba8c-3a832f6fb26e');

		foreach (self::$reactionArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data[0]));
			$this->assertEquals(DataHandler::getVariableType($data[0][$key]), $value['type']);
		}
    }

    public function testGetRepliesReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getReplies('018f3ac9-420d-7061-a921-f16f3733d8de');

		$this->assertEquals($data[0]['id'], '018f3ac9-42dd-707f-ba8c-3a832f6fb26e');

		foreach ($data[0] as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$reactionArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$reactionArray[$key]['type']);
		}
    }

    public function testGetFormReactions()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getFormReactions('018f3ac9-420d-7061-a921-f16f3733d8de');

		$this->assertEquals($data[0]['id'], '018f3ac9-42dd-707f-ba8c-3a832f6fb26e');

		foreach (self::$reactionArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data[0]));
			$this->assertEquals(DataHandler::getVariableType($data[0][$key]), $value['type']);
		}
    }

    public function testGetFormReactionsReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getFormReactions('018f3ac9-420d-7061-a921-f16f3733d8de');

		$this->assertEquals($data[0]['id'], '018f3ac9-42dd-707f-ba8c-3a832f6fb26e');

		foreach ($data[0] as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$reactionArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$reactionArray[$key]['type']);
		}
    }

    public function testGetPaginated()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getPaginated(self::$paginatedParams);

		$this->assertTrue(DataHandler::doesKeyExists('cooperations', $data));
		$this->assertEquals(12, $data['limit']);
		$this->assertEquals(1, $data['page']);

		foreach (self::$cooperationArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data['cooperations'][0]));
			$this->assertEquals(DataHandler::getVariableType($data['cooperations'][0][$key]), $value['type']);
		}
    }

    public function testGetPaginatedReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getPaginated(self::$paginatedParams);

		$this->assertTrue(DataHandler::doesKeyExists('cooperations', $data));
		$this->assertEquals(12, $data['limit']);
		$this->assertEquals(1, $data['page']);

		foreach ($data['cooperations'][0] as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$cooperationArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$cooperationArray[$key]['type']);
		}
    }
}

