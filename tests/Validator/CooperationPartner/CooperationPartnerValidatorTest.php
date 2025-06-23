<?php

namespace Smug\ContactBundle\Tests\Validator\CooperationPartner;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Validator\CooperationPartner\CooperationPartnerValidator;
use Smug\Core\Service\Base\Components\Handler\DataHandler;

class CooperationPartnerValidatorTest extends KernelTestCase
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
		$validator = $this->container->get(CooperationPartnerValidator::class);
		$dataArray = [
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'email' => 'info@example.com',
			'personDetail' => 'Author'
		];
		$data = $validator->validate(
			$dataArray
		);
		$this->assertEquals($data, $dataArray);
    }

    public function testValidateWithoutFirstName()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "firstName" - not given');

		$data = $validator->validate(
			[
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyFirstName()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: firstName and value ""');

		$data = $validator->validate(
			[
				'firstName' => '',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithoutLastName()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "lastName" - not given');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'email' => 'info@example.com',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyLastName()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: lastName and value ""');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'lastName' => '',
				'email' => 'info@example.com',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithoutEmail()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "email" - not given');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithEmptyEmail()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: email and value ""');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => '',
				'personDetail' => 'Author'
			]
		);
    }

    public function testValidateWithoutPersonDetail()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "personDetail" - not given');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com'
			]
		);
    }

    public function testValidateWithEmptyPersonDetail()
    {
		$validator = $this->container->get(CooperationPartnerValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: personDetail and value ""');

		$data = $validator->validate(
			[
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'info@example.com',
				'personDetail' => ''
			]
		);
    }
}

