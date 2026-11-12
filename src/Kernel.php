<?php

namespace App;

use App\Attribute\CheckEnvironmentFlag;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function build(ContainerBuilder $container): void
    {
        // Registering auto-configuration for our attribute
        $container->registerAttributeForAutoconfiguration(
            CheckEnvironmentFlag::class,
            static function (\Symfony\Component\DependencyInjection\ChildDefinition $definition) {
                // We tell Symfony to make this service "lazy" (a lazy proxy)
                $definition->setLazy(true);
                // We add a tag for our logic
                $definition->addTag('app.env_flag_checked');
            }
        );
    }
}
