<?php

namespace Smug\ContactBundle\Tests\Service\Contact;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Service\Contact\Add\AddService;
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
				'email' => 'info@example.com'
			]
		);

		$this->assertTrue($add['success']);
		$this->assertEquals($add['data']['email'], 'info@example.com');
    }

    public function testWithoutEmail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'test' => 'info@example.com'
			]
		);

		$this->assertfalse($add['success']);
		$this->assertEquals('Validation failed for field: "email" - not given', $add['message']);
    }

    public function testWithEmptyEmail()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
				'email' => ''
			]
		);

		$this->assertfalse($add['success']);
		$this->assertEquals('Validation failed for field: email and value ""', $add['message']);
    }

    public function testWithEmptyData()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->add(
			[
			]
		);

		$this->assertfalse($add['success']);
		$this->assertEquals('Validation failed for field: data and value "[]"', $add['message']);
    }

    public function testReply()
    {
		$addService = $this->container->get(AddService::class);
		$add = $addService->reply(
			[
				'id' => '018f3ac9-3f86-70ab-8201-9b511e4693b9',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'subject' => 'Test Subject'
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
				'id' => '018f3ac9-3f86-70ab-8201-9b511e4693b9',
				'email' => 'info@example.com',
				'subject' => 'Test Subject'
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
				'id' => '018f3ac9-3f86-70ab-8201-9b511e4693b9',
				'message' => '',
				'email' => 'info@example.com',
				'subject' => 'Test Subject'
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
				'id' => '018f3ac9-3f86-70ab-8201-9b511e4693b9',
				'message' => null,
				'email' => 'info@example.com',
				'subject' => 'Test Subject'
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
				'id' => '018f3ac9-3f86-70ab-8201-9b511e4693b9',
				'email' => 'info@example.com',
				'message' => 'Test Message'
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
				'id' => '018f3ac9-3f86-70ab-8201-9b511e4693b9',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'subject' => ''
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
				'subject' => 'Test Subject'
			]
		);

		$this->assertFalse($add['success']);
		$this->assertEquals($add['message'], 'Validation failed for field: "contact" - not given');
    }
	
	protected function tearDown(): void
    {
        $this->em->getConnection()->rollback();
    }
}

