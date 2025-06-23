<?php

namespace Smug\ContactBundle\Entity\Media;

use Smug\Core\Entity\Base\BaseModel;
use Smug\Core\Entity\Media\Media;
use Smug\ContactBundle\Entity\ContactReaction\ContactReaction;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\ORM\Mapping\Table;

 #[Entity]
 #[Table('media_contact_reaction_association')]
class MediaContactReactionAssociation extends BaseModel
{
    #[ManyToOne(targetEntity: Media::class)]
    #[JoinColumn(name: 'media_id', referencedColumnName: 'id', onDelete: 'cascade', nullable: true)]
    protected Media $media;

    #[ManyToOne(targetEntity: ContactReaction::class, inversedBy: 'attachments')]
    #[JoinColumn(name: 'contact_reaction_id', referencedColumnName: 'id', onDelete: 'cascade', nullable: true)]
    #[Groups(['minimal'])]
    protected ContactReaction $reaction;

    #[Column(type: 'boolean')]
    protected bool $main;
}
