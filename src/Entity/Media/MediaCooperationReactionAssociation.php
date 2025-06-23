<?php

namespace Smug\ContactBundle\Entity\Media;

use Smug\Core\Entity\Base\BaseModel;
use Smug\Core\Entity\Media\Media;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Smug\ContactBundle\Entity\CooperationReaction\CooperationReaction;
use Symfony\Component\Serializer\Attribute\Groups;

 #[Entity]
 #[Table('media_cooperation_reaction_association')]
class MediaCooperationReactionAssociation extends BaseModel
{
    #[ManyToOne(targetEntity: Media::class)]
    #[JoinColumn(name: 'media_id', referencedColumnName: 'id', onDelete: 'cascade', nullable: true)]
    protected Media $media;

    #[ManyToOne(targetEntity: CooperationReaction::class, inversedBy: 'attachments')]
    #[JoinColumn(name: 'cooperation_reaction_id', referencedColumnName: 'id', onDelete: 'cascade', nullable: true)]
    #[Groups(['minimal'])]
    protected CooperationReaction $reaction;

    #[Column(type: 'boolean')]
    protected bool $main;
}
