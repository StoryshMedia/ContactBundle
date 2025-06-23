<?php

namespace Smug\ContactBundle\Entity\Cooperation;

use Smug\Core\Entity\Base\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Smug\ContactBundle\Entity\CooperationReaction\CooperationReaction;
use Smug\ContactBundle\Entity\CooperationPartner\CooperationPartner;
use Smug\Core\Entity\Base\Attribute\BackendField;
use Symfony\Component\Serializer\Attribute\Groups;

 #[Entity]
 #[Table('cooperation')]
class Cooperation extends BaseModel
{
    #[Column(type: 'string')]
    #[BackendField(config: [
        'type' => 'Text',
        'placeholder' => 'FIRST_NAME',
        'config' =>  [
            'disabled' => true
        ]
    ])]
    protected string $firstName;

    #[Column(type: 'string')]
    #[BackendField(config: [
        'type' => 'Text',
        'placeholder' => 'LAST_NAME',
        'config' =>  [
            'disabled' => true
        ]
    ])]
    protected string $lastName;

    #[Column(type: 'string')]
    #[BackendField(config: [
        'type' => 'Text',
        'placeholder' => 'EMAIL',
        'config' =>  [
            'disabled' => true
        ]
    ])]
    protected string $email;

    #[Column(type: 'string')]
    #[BackendField(config: [
        'type' => 'Selectbox',
        'placeholder' => 'REASON',
        'config' => [
            'disabled' => true,
            'items' => [
                [
                    'title' => 'BOOK_PUBLISHING',
                    'value' => 'bookPublishing'
                ],
                [
                    'title' => 'INTERVIEWS',
                    'value' => 'intrview'
                ],
                [
                    'title' => 'OTHER_REASON',
                    'value' => 'otherReason'
                ]
            ]
        ]
    ])]
    protected string $reason;

    #[Column(type: 'string')]
    #[BackendField(config: [
        'type' => 'Selectbox',
        'placeholder' => 'PERSON_DETAIL',
        'config' => [
            'disabled' => true,
            'items' => [
                [
                    'title' => 'AUTHOR',
                    'value' => 'author'
                ],
                [
                    'title' => 'PUBLISHER',
                    'value' => 'publisher'
                ],
                [
                    'title' => 'BLOG_OWNER',
                    'value' => 'blogOwner'
                ],
                [
                    'title' => 'SOMETHING_ELSE',
                    'value' => 'sometingElse'
                ]
            ]
        ]
    ])]
    protected string $personDetail;

    #[Column(type: 'string')]
    #[BackendField(config: [
        'type' => 'Text',
        'placeholder' => 'DATE',
        'config' =>  [
            'disabled' => true
        ]
    ])]
    protected string $cooperationDate;

    #[Column(type: 'string')]
    #[BackendField(config: [
        'type' => 'Text',
        'placeholder' => 'HASH',
        'config' =>  [
            'disabled' => true
        ]
    ])]
    protected string $hash;

    #[Column(type: 'text')]
    #[BackendField(config: [
        'type' => 'Editor',
        'placeholder' => 'MESSAGE',
        'config' => [
            'disabled' => true,
            'mentions' => false
        ]
    ])]
    protected string $message;

    #[OneToMany(targetEntity: CooperationReaction::class, mappedBy: 'cooperation')]
    #[Groups(['list'])]
    #[BackendField(config: [
        'type' => 'Accordion',
        'placeholder' => '',
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
    ])]
    protected Collection $reactions;

    #[ManyToOne(targetEntity: CooperationPartner::class, inversedBy: 'cooperations')]
    #[JoinColumn(name: 'partner_id', referencedColumnName: 'id', onDelete: 'cascade', nullable: true)]
    #[Groups(['list'])]
    #[BackendField(config: [
        'type' => 'Card',
        'placeholder' => 'PARTNER',
        'config' => [
            'returnObject' => true,
            'headlineIdentifier' => 'lastName',
            'descriptionIdentifier' => 'firstName',
            'buttonText' => 'TO_PARTNER',
            'buttonLink' => '/admin/smug/contact/cooperation_partner/detail/'
        ]
    ])]
    protected ?CooperationPartner $partner = null;

    public function __construct()
    {
        $this->reactions = new ArrayCollection();
    }
}
