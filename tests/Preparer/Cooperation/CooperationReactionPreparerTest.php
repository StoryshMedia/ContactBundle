<?php

namespace Smug\ContactBundle\Tests\Preparer\Cooeration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Smug\ContactBundle\Preparer\Cooperation\CooperationReactionPreparer;
use Smug\Core\Service\Base\Components\Handler\DataHandler;
use Smug\Core\Service\Base\Components\Handler\TimeHandler;

class CooperationReactionPreparerTest extends KernelTestCase
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
		$preparer = $this->container->get(CooperationReactionPreparer::class);
		$data = $preparer->prepare(
			['test1' => true],
			['test2' => false]
		);

		$this->assertTrue($data['test1']);
		$this->assertFalse($data['test2']);
		$this->assertTrue(DataHandler::doesKeyExists('reactionDate', $data));
		$this->assertEquals($data['reactionDate'], TimeHandler::getNewDateObject()->format('d.m.Y'));
    }
}

