<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/10/2018
 * Time: 13:57
 */

namespace ScyLabs\ApimoBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(){

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('apimo');

        $rootNode
            ->children()
                ->arrayNode('api')->isRequired()
                    ->children()
                        ->variableNode('token')->isRequired()->end()
                        ->variableNode('provider')->isRequired()->end()
                        ->variableNode('agency')->isRequired()->end()
                        ->variableNode('errors_contact_mail')->isRequired()->end()
                        ->variableNode('baseurl')
                            ->defaultValue('https://api.apimo.pro')
                        ->end()
                        ->variableNode('urls')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }

}