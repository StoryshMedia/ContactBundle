<?php

namespace Smug\ContactBundle\Entity\Contact;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Smug\Core\Entity\Base\BaseModel;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Smug\ContactBundle\Entity\ContactReaction\ContactReaction;
use Smug\Core\Entity\Base\Attribute\DefaultValue;
use Symfony\Component\Serializer\Attribute\Groups;

 #[Entity]
 #[Table('contact')]
class Contact extends BaseModel
{
    #[Column(type: 'jsonField')]
    #[DefaultValue('[]')]
    protected string|array $data;

    #[OneToMany(targetEntity: ContactReaction::class, mappedBy: 'contact')]
    #[Groups(['list'])]
    protected Collection $reactions;

    public function __construct()
    {
        $this->reactions = new ArrayCollection();
    }
}
