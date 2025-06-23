<?php

namespace Smug\ContactBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Smug\ContactBundle\DependencyInjection\SmugContactExtension;

class SmugContactBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new SmugContactExtension();
    }
}
