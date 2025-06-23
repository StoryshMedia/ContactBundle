<?php

namespace Smug\ContactBundle\Tests\Validator\Contact;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Validator\Contact\ContactReactionValidator;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\ContactBundle\Entity\Contact\Contact;

class ContactReactionValidatorTest extends KernelTestCase
{
	protected $container;

	protected function setUp(): void
    {
        self::bootKernel([
			"environment" => 'test'
		  ]);
        $this->container = static::getContainer();
    }

    public function testValidate()
    {
		$validator = $this->container->get(ContactReactionValidator::class);
		$dataArray = [
			'message' => 'Test message',
			'subject' => 'Test Subject',
			'contact' => new Contact()
		];
		$data = $validator->validate(
			$dataArray
		);
		$this->assertEquals($data, $dataArray);
    }

    public function testValidateWithoutMessage()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "message" - not given');

		$data = $validator->validate([
			'subject' => 'Test Subject',
			'contact' => new Contact()
		]);
    }

    public function testValidateWithEmptyMessage()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: message and value ""');

		$data = $validator->validate([
			'message' => '',
			'subject' => 'Test Subject',
			'contact' => new Contact()
		]);
    }

    public function testValidateWithNullMessage()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: message and value ""');

		$data = $validator->validate([
			'message' => null,
			'subject' => 'Test Subject',
			'contact' => new Contact()
		]);
    }

    public function testValidateWithoutSubject()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "subject" - not given');

		$data = $validator->validate([
			'message' => 'Test message',
			'contact' => new Contact()
		]);
    }

    public function testValidateWithEmptySubject()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: subject and value ""');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => '',
			'contact' => new Contact()
		]);
    }

    public function testValidateWithNullSubject()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: subject and value ""');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => null,
			'contact' => new Contact()
		]);
    }

    public function testValidateWithoutContact()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "contact" - not given');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => 'Test Subject'
		]);
    }

    public function testValidateWithEmptyContact()
    {
		$validator = $this->container->get(ContactReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: contact and value ""');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => 'Test Subject',
			'contact' => null
		]);
    }
}

