<?php

namespace Smug\ContactBundle\Constants\Views\Backend;

use Smug\ContactBundle\Entity\CooperationPartner\CooperationPartner;
use Smug\Core\Service\Base\Interfaces\Backend\BackendDataConstantsInterface;

class CooperationPartnerConstants implements BackendDataConstantsInterface
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
					'identifier' => 'personDetail',
					'type' => 'string'
				]
			],
			'type' => 'table',
			'model' => CooperationPartner::class,
			'listConfig' => [
				'showLogo' => false,
				'url' => [
					'detail' => true,
					'add' => true
				],
				'paginatorModel' => 'partners',
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
			'model' => CooperationPartner::class,
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
						'fields' => ['firstName', 'lastName', 'email']
					],
					[
						'class' => 'grid grid-cols-1 gap-5 mb-12',
						'fields' => ['personDetail']
					]
				]
			],
			[
				'headline' => 'COOPERATIONS',
				'type' => 'standard',
				'rows' => [
					[
						'class' => 'grid grid-cols-1 md:grid-cols-3 gap-5 mb-12',
						'fields' => ['cooperations']
					]
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
