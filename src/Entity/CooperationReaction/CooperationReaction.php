<?php

namespace Smug\ContactBundle\Entity\CooperationReaction;

use Smug\Core\Entity\Base\BaseModel;
use Smug\ContactBundle\Entity\Media\MediaCooperationReactionAssociation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Smug\ContactBundle\Entity\Cooperation\Cooperation;
use Symfony\Component\Serializer\Attribute\Groups;

 #[Entity]
 #[Table('cooperation_reatcion')]
class CooperationReaction extends BaseModel
{
    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    #[Column(type: 'string')]
    protected string $subject;

    #[Column(type: 'text')]
    protected string $message;

    #[Column(type: 'string')]
    protected string $reactionDate;

    #[Column(type: 'string')]
    protected string $type;

    #[OneToMany(targetEntity: MediaCooperationReactionAssociation::class, mappedBy: 'reaction')]
    protected Collection $attachments;

    #[ManyToOne(targetEntity: Cooperation::class, inversedBy: 'reactions')]
    #[JoinColumn(name: 'cooperation_id', referencedColumnName: 'id', onDelete: 'cascade', nullable: true)]
    #[Groups(['minimal'])]
    protected Cooperation $cooperation;

    public function addAttachment(MediaCooperationReactionAssociation $attachments): CooperationReaction
    {
        $this->attachments[] = $attachments;

        return $this;
    }

    public function removeAttachment(MediaCooperationReactionAssociation $attachments)
    {
        $this->attachments->removeElement($attachments);
    }
}
