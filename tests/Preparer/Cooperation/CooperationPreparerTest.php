<?php

namespace Smug\ContactBundle\Tests\Preparer\Cooperation;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Preparer\Cooperation\CooperationPreparer;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\Core\Service\Base\Components\Handler\TimeHandler;

class CooperationPreparerTest extends KernelTestCase
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
		$preparer = $this->container->get(CooperationPreparer::class);
		$data = $preparer->prepare(
			[],
			[]
		);

		$this->assertTrue(DataHandler::doesKeyExists('cooperationDate', $data));
		$this->assertEquals($data['cooperationDate'], TimeHandler::getNewDateObject()->format('d.m.Y'));
    }
}

