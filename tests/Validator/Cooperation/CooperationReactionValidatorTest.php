<?php

namespace Smug\ContactBundle\Tests\Validator\Cooperation;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Validator\Cooperation\CooperationReactionValidator;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\ContactBundle\Entity\Cooperation\Cooperation;

class CooperationReactionValidatorTest extends KernelTestCase
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
		$validator = $this->container->get(CooperationReactionValidator::class);
		$dataArray = [
			'message' => 'Test message',
			'subject' => 'Test Subject',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'cooperation' => new Cooperation()
		];
		$data = $validator->validate(
			$dataArray
		);
		$this->assertEquals($data, $dataArray);
    }

    public function testValidateWithoutMessage()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "message" - not given');

		$data = $validator->validate([
			'subject' => 'Test Subject',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'contact' => new Cooperation()
		]);
    }

    public function testValidateWithEmptyMessage()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: message and value ""');

		$data = $validator->validate([
			'message' => '',
			'subject' => 'Test Subject',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'contact' => new Cooperation()
		]);
    }

    public function testValidateWithNullMessage()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: message and value ""');

		$data = $validator->validate([
			'message' => null,
			'subject' => 'Test Subject',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'contact' => new Cooperation()
		]);
    }

    public function testValidateWithoutSubject()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "subject" - not given');

		$data = $validator->validate([
			'message' => 'Test message',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'contact' => new Cooperation()
		]);
    }

    public function testValidateWithEmptySubject()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: subject and value ""');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => '',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'contact' => new Cooperation()
		]);
    }

    public function testValidateWithNullSubject()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: subject and value ""');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => null,
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'contact' => new Cooperation()
		]);
    }

    public function testValidateWithoutCooperation()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: "cooperation" - not given');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => 'Test Subject',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024'
		]);
    }

    public function testValidateWithEmptyCooperation()
    {
		$validator = $this->container->get(CooperationReactionValidator::class);

		$this->expectException(\Smug\Core\Exception\Base\NotValidException::class);
		$this->expectExceptionMessage('Validation failed for field: cooperation and value ""');

		$data = $validator->validate([
			'message' => 'Test message',
			'subject' => 'Test Subject',
			'type' => 'Test Subject',
			'reactionDate' => '14.03.2024',
			'cooperation' => null
		]);
    }
}

