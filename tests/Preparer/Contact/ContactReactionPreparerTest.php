<?php

namespace Smug\ContactBundle\Tests\Preparer\Contact;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Preparer\Contact\ContactReactionPreparer;
use Smug\Core\Service\Base\Components\Handler\DataHandler;

class ContactReactionPreparerTest extends KernelTestCase
{
	protected $container;

	protected function setUp(): void
    {
        self::bootKernel([
			"environment" => 'test'
		  ]);
        $this->container = static::getContainer();
    }

    public function testPrepare()
    {
		$preparer = $this->container->get(ContactReactionPreparer::class);
		$data = $preparer->prepare(
			['test1' => true],
			['test2' => false]
		);

		$this->assertTrue($data['test1']);
		$this->assertFalse($data['test2']);
    }
}

