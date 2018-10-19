<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01/08/2018
 * Time: 12:16
 */

namespace ScyLabs\ApimoBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


class ScyLabsApimoExtension extends Extension
{
    public function load(array $configs,ContainerBuilder $container){

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration,$configs);

        $container->setParameter($this->getAlias().'.api',$config['api']);
        $container->setParameter($this->getAlias().'.api.token',$config['api']['token']);
        $container->setParameter($this->getAlias().'.api.provider',$config['api']['provider']);
        $container->setParameter($this->getAlias().'.api.agency',$config['api']['agency']);
        $container->setParameter($this->getAlias().'.api.baseurl',$config['api']['baseurl']);
        $container->setParameter($this->getAlias().'.api.errors_contact_mail',$config['api']['errors_contact_mail']);

        if(isset($config['api']['urls'])){
            if(!isset($config['api']['urls']['categories'])){
                $config['api']['urls']['categories'] = '/catalogs/property_category';
            }
            if(!isset($config['api']['urls']['property_type'])){
                $config['api']['urls']['property_type'] = '/catalogs/property_type';
            }
            if(!isset($config['api']['urls']['properties'])){
                $config['api']['urls']['properties'] = '/agencies/'.$config['api']['agency'].'/properties';
            }

            $container->setParameter($this->getAlias().'.api.urls',$config['api']['urls']);
        }
        else{
            // Define defaults values to urls , if parameter not configure
            $container->setParameter($this->getAlias().'.api.urls',array(

                    'categories'        =>  '/catalogs/property_category',
                    'properties'        =>  '/agencies/'.$config['api']['agency'].'/properties',
                    'property_type'     => '/catalogs/property_type',

            ));
        }

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(dirname(__DIR__).'/Resources/config')
        );
        $loader->load('services.yaml');



    }
}