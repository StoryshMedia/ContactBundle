<?php

namespace Smug\ContactBundle\Tests\Service\Cooperation;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Service\Cooperation\Add\AddService;
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
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
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
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
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
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
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
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
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
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: lastName and value ""');
    }

    public function testAddWithoutMessage()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "message" - not given');
    }

    public function testAddWithEmptyMessage()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'message' => '',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: message and value ""');
    }

    public function testAddWithoutEmail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'message' => 'Test Message',
				'reason' => 'Test Reason',
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
				'message' => 'Test Message',
				'email' => '',
				'reason' => 'Test Reason',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: email and value ""');
    }

    public function testAddWithoutReason()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "reason" - not given');
    }

    public function testAddWithEmptyReason()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => '',
				'personDetail' => 'Test Detail'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: reason and value ""');
    }

    public function testAddWithoutPersonDetail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'firstName' => 'Test Firstname',
				'lastName' => 'Test Laststname',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason'
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
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => ''
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: personDetail and value ""');
    }

    public function testReply()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'id' => '018f3ac9-420b-7226-81b6-404e3861c929',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'subject' => 'Test Subject',
				'type' => 'Test Subject',
				'reactionDate' => '14.03.2024'
			]
		);

		$this->assertTrue($add['success']);
		$this->assertEquals($add['data']['subject'], 'Test Subject');
    }

    public function testReplyWithoutMessage()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'id' => '018f3ac9-420b-7226-81b6-404e3861c929',
				'email' => 'info@example.com',
				'subject' => 'Test Subject',
				'type' => 'Test Subject',
				'reactionDate' => '14.03.2024'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "message" - not given');
    }

    public function testReplyWithEmptyMessage()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'id' => '018f3ac9-420b-7226-81b6-404e3861c929',
				'message' => '',
				'email' => 'info@example.com',
				'subject' => 'Test Subject',
				'type' => 'Test Subject',
				'reactionDate' => '14.03.2024'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: message and value ""');
    }

    public function testReplyWithNullMessage()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'id' => '018f3ac9-420b-7226-81b6-404e3861c929',
				'message' => null,
				'email' => 'info@example.com',
				'subject' => 'Test Subject',
				'type' => 'Test Subject',
				'reactionDate' => '14.03.2024'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: message and value ""');
    }

    public function testReplyWithoutSubject()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'id' => '018f3ac9-420b-7226-81b6-404e3861c929',
				'email' => 'info@example.com',
				'message' => 'Test Message',
				'type' => 'Test Subject',
				'reactionDate' => '14.03.2024'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "subject" - not given');
    }

    public function testReplyWithEmptySubject()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'id' => '018f3ac9-420b-7226-81b6-404e3861c929',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'subject' => '',
				'type' => 'Test Subject',
				'reactionDate' => '14.03.2024'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: subject and value ""');
    }

    public function testReplyWithoutId()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'message' => 'Test Message',
				'subject' => 'Test Subject',
				'type' => 'Test Subject',
				'reactionDate' => '14.03.2024'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "cooperation" - not given');
    }
	
	protected function tearDown(): void
    {
        $this->em->getConnection()->rollback();
    }
}

