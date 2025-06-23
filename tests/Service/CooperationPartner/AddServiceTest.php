<?php

namespace Smug\ContactBundle\Tests\Service\CooperationPartner;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Service\CooperationPartner\Add\AddService;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\FrontendUserBundle\Entity\FrontendUser\FrontendUser;

class AddServiceTest extends KernelTestCase
{
	protected $container;
	protected $em;

	protected function setUp(): void
    {
        self::bootKernel([
			"environment" => 'test'
		  ]);
        $this->container = static::getContainer();
		$this->em = $this->container
			->get('doctrine')
			->getManager();

        $this->em->getConnection()->beginTransaction();
    }

    public function testAdd()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertTrue($add['success']);
		$this->assertEquals($add['data']['email'], 'info@example.com');
    }

    public function testAddWithoutFirstName()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "firstName" - not given');
    }

    public function testAddWithEmptyFirstName()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => '',
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: firstName and value ""');
    }

    public function testAddWithNullFirstName()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => null,
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: firstName and value ""');
    }

    public function testAddWithoutLastName()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "lastName" - not given');
    }

    public function testAddWithEmptyLastName()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => '',
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: lastName and value ""');
    }

    public function testAddWithNullLastName()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => null,
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: lastName and value ""');
    }

    public function testAddWithoutEmail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "email" - not given');
    }

    public function testAddWithEmptyEmail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'email' => '',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: email and value ""');
    }

    public function testAddWithNullEmail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'email' => null,
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: email and value ""');
    }

    public function testAddWithoutPersonDetail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "personDetail" - not given');
    }

    public function testAddWithEmptyPersonDetail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com',
				'personDetail' => ''
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: personDetail and value ""');
    }

    public function testAddWithNullPersonDetail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com',
				'personDetail' => null
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: personDetail and value ""');
    }
	
	protected function tearDown(): void
    {
        $this->em->getConnection()->rollback();
    }
}

