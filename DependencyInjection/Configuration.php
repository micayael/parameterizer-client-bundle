<?php

namespace Micayael\Parameterizer\ClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('parameterizer_client');

        $rootNode
            ->children()
                ->scalarNode('host')
                    ->info('Servidor del parameterizer (http://localhost:8080)')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('uri')
                    ->info('URI del servicio para obtener los parámetros')
                    ->defaultValue('/api/parametros')
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('username')
                    ->info('Usuario de conexión al parameterizer')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('password')
                    ->info('Password de conexión al parameterizer')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('agrupado')
                    ->info('Indica si se debe recibir el json de parámetros plano o agrupando los parámetros por dominio')
                    ->defaultTrue()
                ->end()

            ->end()
        ;

        return $treeBuilder;
    }
}
