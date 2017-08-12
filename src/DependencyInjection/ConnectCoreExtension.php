<?php

namespace Wr\Connect\CoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;



class ConnectCoreExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $value = Yaml::parse(file_get_contents(__DIR__.'/../Resources/config/connect_config.yml'));
        $container->setParameter('connect',$value);
    }

    public function prepend(ContainerBuilder $container){

        $config=array
        (
            'orm' => array(
                'mappings' => array(
                    'ConnectCoreBundle' => array(
                        'mapping' => 'true'
                    )
                )
            )
        );

        $container->prependExtensionConfig('doctrine',$config);
    }
}
