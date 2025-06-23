<?php

namespace Smug\ContactBundle\Entity\ContactReaction;

use Smug\ContactBundle\Entity\Media\MediaContactReactionAssociation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Smug\Core\Entity\Base\BaseModel;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\ORM\Mapping\Table;
use Smug\ContactBundle\Entity\Contact\Contact;

 #[Entity]
 #[Table('contact_reatcion')]
class ContactReaction extends BaseModel
{
    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    #[Column(type: 'string')]
    protected string $subject;

    #[Column(type: 'text')]
    protected string $message;

    #[OneToMany(targetEntity: MediaContactReactionAssociation::class, mappedBy: 'reaction')]
    #[Groups(['list'])]
    protected Collection $attachments;

    #[ManyToOne(targetEntity: Contact::class, inversedBy: 'reactions')]
    #[JoinColumn(name: 'contact_id', referencedColumnName: 'id', onDelete: 'cascade', nullable: true)]
    #[Groups(['minimal'])]
    protected Contact $contact;

    public function addAttachment(MediaContactReactionAssociation $attachments): ContactReaction
    {
        $this->attachments[] = $attachments;

        return $this;
    }

    public function removeAttachment(MediaContactReactionAssociation $attachments)
    {
        $this->attachments->removeElement($attachments);
    }
}
