<?php

namespace Smug\ContactBundle\Constants\Views\Backend;

use Smug\ContactBundle\Entity\Cooperation\Cooperation;
use Smug\Core\Service\Base\Interfaces\Backend\BackendDataConstantsInterface;

class CooperationConstants implements BackendDataConstantsInterface
{
	const LIST_DATA = [
		'config' => [
			'columns' => [
				[
					'identifier' => 'firstName',
					'type' => 'string'
				],
				[
					'identifier' => 'lastName',
					'type' => 'string'
				],
				[
					'identifier' => 'email',
					'type' => 'string'
				],
				[
					'identifier' => 'reason',
					'type' => 'string'
				]
			],
			'type' => 'table',
			'model' => Cooperation::class,
			'listConfig' => [
				'showLogo' => false,
				'url' => [
					'detail' => true,
					'add' => true
				],
				'paginatorModel' => 'cooperations',
				'deleteSelected' => true,
				'batchProcessing' => false,
				'paginationLimits' => [5, 10, 20, 50, 100]
			],
			'sortings' => [],
			'filters' => []
		]
	];

	const DETAIL_DATA = [
		'config' => [
			'model' => Cooperation::class,
			'url' => [
				'save' => true,
				'delete' => true
			],
		],
		'tabs' => [
			[
				'headline' => 'BASE_SETTINGS',
				'type' => 'standard',
				'rows' => [
					[
						'class' => 'grid grid-cols-1 md:grid-cols-3 gap-5 mb-12',
						'fields' => ['firstName', 'lastName', 'email', 'hash']
					],
					[
						'class' => 'grid grid-cols-1 md:grid-cols-3 gap-5 mb-12',
						'fields' => ['cooperationDate', 'reason', 'personDetail']
					],
					[
						'class' => 'grid grid-cols-1 my-8',
						'fields' => ['partner']
					],
					[
						'class' => 'grid grid-cols-1 my-8',
						'fields' => ['message']
					]
				]
			],
			[
				'headline' => 'REACTIONS',
				'icon' => 'IconShare',
				'type' => 'standard',
				'rows' => [
					[
						'class' => 'grid grid-cols-1 gap-5 mb-12',
						'fields' => [
							[
								'type' => 'ContactReaction',
								'placeholder' => '',
								'config' => [
									'identifier' => 'cooperation',
									'bypassId' => true,
									'call' => '/be/api/custom/cooperation/reaction/send'
								]
							]
						]
					],
					[
						'class' => 'grid grid-cols-1 my-8',
						'fields' => ['reactions']
					],
				]
			]
		]
	];

	public static function getListConstants(): array
	{
		return self::LIST_DATA;
	}

	public static function getDetailConstants(): array
	{
		return self::DETAIL_DATA;
	}

	public static function getAddConstants(): array
	{
		return [];
	}

	public static function getReadingRights(): string
	{
		return '';
	}

	public static function getWritingRights(): string
	{
		return '';
	}
}
