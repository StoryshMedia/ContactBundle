<?php

namespace Smug\ContactBundle\Tests\Validator\Cooperation;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Validator\Cooperation\CooperationValidator;
use Smug\Core\Service\Base\Components\Handler\DataHandler;

class CooperationValidatorTest extends KernelTestCase
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
		$validator = $this->container->get(CooperationValidator::class);
		$dataArray = [
			'firstName' => 'First Name',
			'message' => 'Test Message',
			'lastName' => 'Last Name',
			'email' => 'info@example.com',
			'reason' => 'Test Reason',
			'personDetail' => 'Author'
		];
		$data = $validator->validate(
			$dataArray
		);
		$this->assertEquals($data, $dataArray);
    }

    public function testValidateWithoutFirstName()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "firstName" - not given');

		$data = $validator->validate(
			[
				'lastName' => 'Last Name',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyFirstName()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: firstName and value ""');

		$data = $validator->validate(
			[
				'firstName' => '',
				'lastName' => 'Last Name',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithoutLastName()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "lastName" - not given');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyLastName()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: lastName and value ""');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'lastName' => '',
				'message' => 'Test Message',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithoutEmail()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "email" - not given');

		$data = $validator->validate(
			[
				'message' => 'Test Message',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyEmail()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: email and value ""');

		$data = $validator->validate(
			[
				'message' => 'Test Message',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => '',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithoutReason()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "reason" - not given');

		$data = $validator->validate(
			[
				'message' => 'Test Message',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyReason()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: reason and value ""');

		$data = $validator->validate(
			[
				'message' => 'Test Message',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'reason' => '',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithoutPersonDetail()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "personDetail" - not given');

		$data = $validator->validate(
			[
				'message' => 'Test Message',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
			]
		);
    }

    public function testValidateWithEmptyPersonDetail()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: personDetail and value ""');

		$data = $validator->validate(
			[
				'message' => 'Test Message',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => ''
			]
		);
    }

    public function testValidateWithoutMessage()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "message" - not given');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyMessage()
    {
		$validator = $this->container->get(CooperationValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: message and value ""');

		$data = $validator->validate(
			[
				'message' => '',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'reason' => 'Test Reason',
				'personDetail' => 'Author'
			]
		);
    }
}

