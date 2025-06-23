<?php

namespace Smug\ContactBundle\Entity\CooperationPartner;

use Smug\Core\Entity\Base\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Smug\ContactBundle\Entity\Cooperation\Cooperation;
use Smug\Core\Entity\Base\Attribute\BackendField;
use Symfony\Component\Serializer\Attribute\Groups;

 #[Entity]
 #[Table('cooperation_partner')]
class CooperationPartner extends BaseModel
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

    #[OneToMany(targetEntity: Cooperation::class, mappedBy: 'partner')]
    #[Groups(['minimal'])]
    #[BackendField(config: [
       'type' => 'Multiple',
       'placeholder' => 'COOPERATIONS',
       'information' => '',
       'config' => [
           'type' => 'Card',
           'bypassId' => true,
           'placeholder' => '',
           'config' => [
               'returnObject' => true,
               'identifier' => 'cooperation',
               'headlineIdentifier' => 'firstName',
               'descriptionIdentifier' => 'lastName',
               'buttonText' => 'TO_COOPERATION',
               'buttonLink' => '/admin/smug/contact/cooperation/detail/'
           ]
       ]
   ])]
    protected Collection $cooperations;

    public function __construct()
    {
        $this->cooperations = new ArrayCollection();
    }
}
