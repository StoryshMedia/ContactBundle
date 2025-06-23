<?php

namespace Smug\ContactBundle\Tests\Service\CooperationPartner;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Service\CooperationPartner\Listing\ListService;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\FrontendUserBundle\Entity\FrontendUser\FrontendUser;

class ListServiceTest extends KernelTestCase
{
	protected $container;

	private static $paginatedParams = [
		"showLogo" => false,
		"getUrl" => "/be/api/cooperation/partner/get/paginated",
		"editLink" => "/cooperation_partner/edit/",
		"paginatorModel" => "cooperationPartners",
		"zone" => "cooperation_partner",
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

	private static $cooperationPartnerArray = [
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
		"name" => [
			'type' => 'string'
		]
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
		"reactions" => [
			'type' => 'array'
		],
		"partner" => [
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

		$data = $listService->getSingle('018f3ac9-427a-72c7-a23f-58d863869e2e');

		$this->assertEquals($data['id'], '018f3ac9-427a-72c7-a23f-58d863869e2e');
		$this->assertEquals($data['email'], 'Alexander-Voss1985@web.de');

		foreach (self::$cooperationPartnerArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data));
			$this->assertEquals(DataHandler::getVariableType($data[$key]), $value['type']);
		}
    }

    public function testGetSingleReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getSingle('018f3ac9-427a-72c7-a23f-58d863869e2e');

		$this->assertEquals($data['id'], '018f3ac9-427a-72c7-a23f-58d863869e2e');
		$this->assertEquals($data['email'], 'Alexander-Voss1985@web.de');

		foreach ($data as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$cooperationPartnerArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$cooperationPartnerArray[$key]['type']);
		}
    }

    public function testGetSingleWithFalseId()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getSingle('018f3ac9-42dd-707f-ba8c-3a832f6fb264');
		
		$this->assertFalse($data['success']);
		$this->assertEquals($data['message'], 'No data found for identifier 018f3ac9-42dd-707f-ba8c-3a832f6fb264');
    }

    public function testGetCooperations()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getCooperations('018f3ac9-427a-72c7-a23f-58d863869e2e');

		$this->assertEquals($data[0]['id'], '018f3ac9-420d-7061-a921-f16f3733d8de');

		foreach (self::$cooperationArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data[0]));
			$this->assertEquals(DataHandler::getVariableType($data[0][$key]), $value['type']);
		}
    }

    public function testGetCooperationsReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getCooperations('018f3ac9-427a-72c7-a23f-58d863869e2e');

		$this->assertEquals($data[0]['id'], '018f3ac9-420d-7061-a921-f16f3733d8de');

		foreach ($data[0] as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$cooperationArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$cooperationArray[$key]['type']);
		}
    }

    public function testGetPaginated()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getPaginated(self::$paginatedParams);

		$this->assertTrue(DataHandler::doesKeyExists('cooperationPartners', $data));
		$this->assertEquals(12, $data['limit']);
		$this->assertEquals(1, $data['page']);

		foreach (self::$cooperationPartnerArray as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, $data['cooperationPartners'][0]));
			$this->assertEquals(DataHandler::getVariableType($data['cooperationPartners'][0][$key]), $value['type']);
		}
    }

    public function testGetPaginatedReverse()
    {
		$listService = $this->container->get(ListService::class);

		$data = $listService->getPaginated(self::$paginatedParams);

		$this->assertTrue(DataHandler::doesKeyExists('cooperationPartners', $data));
		$this->assertEquals(12, $data['limit']);
		$this->assertEquals(1, $data['page']);

		foreach ($data['cooperationPartners'][0] as $key => $value) {
			$this->assertTrue(DataHandler::doesKeyExists($key, self::$cooperationArray));
			$this->assertEquals(DataHandler::getVariableType($value), self::$cooperationArray[$key]['type']);
		}
    }
}

