<?php

namespace Smug\ContactBundle\Tests\Validator\Contact;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Validator\Contact\ContactValidator;
use Smug\Core\Service\Base\Components\Handler\DataHandler;

class ContactValidatorTest extends KernelTestCase
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
		$validator = $this->container->get(ContactValidator::class);
		$dataArray = [
			'data' => [
				'test' => true
			],
			'email' => 'info@example.com'
		];
		$data = $validator->validate(
			$dataArray
		);
		$this->assertEquals($data, $dataArray);
    }

    public function testValidateWithDataEmpty()
    {
		$validator = $this->container->get(ContactValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: data and value "[]"');
		
		$data = $validator->validate(
			[
				'data' => [],
				'email' => 'info@example.com'
			]
		);
    }

    public function testValidateWithoutData()
    {
		$validator = $this->container->get(ContactValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "data" - not given');
		
		$data = $validator->validate(
			[
				'email' => 'info@example.com'
			]
		);
    }

    public function testValidateWithEmailEmpty()
    {
		$validator = $this->container->get(ContactValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: email and value ""');
		
		$data = $validator->validate(
			[
				'data' => [
					'test' => true
				],
				'email' => ''
			]
		);
    }

    public function testValidateWithoutEmail()
    {
		$validator = $this->container->get(ContactValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "email" - not given');
		
		$data = $validator->validate(
			[
				'data' => [
					'test' => true
				]
			]
		);
    }
}

