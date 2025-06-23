<?php

namespace Smug\ContactBundle\Constants\Views\Backend;

use Smug\ContactBundle\Entity\Contact\Contact;
use Smug\Core\Service\Base\Interfaces\Backend\BackendDataConstantsInterface;

class ContactConstants implements BackendDataConstantsInterface
{
	const LIST_DATA = [
		'config' => [
			'columns' => [
				[
					'identifier' => 'data',
					'type' => 'array'
				]
			],
			'type' => 'table',
			'model' => Contact::class,
			'listConfig' => [
				'showLogo' => false,
				'url' => [
					'detail' => true,
					'add' => true
				],
				'paginatorModel' => 'contacts',
				'deleteSelected' => true,
				'batchProcessing' => false,
				'paginationLimits' => [5, 10, 20, 50, 100]
			],
			'sortings' => [],
			'filters' => []
		]
	];

	const ADD_DATA = [
		'config' => [
			'model' => Contact::class,
			'url' => [
				'save' => true
			],
		],
		'tabs' => [
			[
				'headline' => 'BASE_SETTINGS',
				'type' => 'standard',
				'rows' => [
					[
						'class' => 'grid grid-cols-1 gap-5 mb-12',
						'fields' => [
							[
								'type' => 'Text',
								'placeholder' => 'TITLE',
								'identifier' => 'title'
							]
						]
					]
				]
			]
		]
	];

	const DETAIL_DATA = [
		'config' => [
			'model' => Contact::class,
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
						'class' => 'grid grid-cols-1 gap-5 mb-12',
						'fields' => [
							[
								'type' => 'JsonOutputArray',
								'placeholder' => '',
								'identifier' => 'data'
							]
						]
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
									'identifier' => 'contact',
									'bypassId' => true,
									'call' => '/be/api/custom/contact/reaction/send'
								]
							]
						]
					],
					[
						'class' => 'grid grid-cols-1 my-8',
						'fields' => [
							[
								'type' => 'Accordion',
								'placeholder' => '',
								'identifier' => 'reactions',
								'config' => [
									'headlineIdentifier' => 'subject',
									'fields' => [
										[
											'type' => 'Output',
											'placeholder' => '',
											'identifier' => 'subject',
											'config' => [
												'showHeader' => true,
												'header' => 'SUBJECT'
											]
										],
										[
											'type' => 'Output',
											'placeholder' => '',
											'identifier' => 'message',
											'config' => [
												'showHeader' => true,
												'header' => 'MESSAGE'
											]
										]
									]
								]
							]
						]
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
		return self::ADD_DATA;
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
