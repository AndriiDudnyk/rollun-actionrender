<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.03.17
 * Time: 17:02
 */

namespace rollun\actionrender\MiddlewareDeterminator\Factory;

use Interop\Container\ContainerInterface;
use rollun\actionrender\MiddlewareDeterminator\Attribute;

class AttributeAbstractFactory extends AbstractLazyLoadMiddlewareGetterAbstractFactory
{

    const EXTENDER_CLASS = Attribute::class;

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        $factoryConfig = $config[static::KEY][$requestedName];
        $class = $factoryConfig[static::KEY_CLASS];
        return new $class($factoryConfig[static::KEY_ATTRIBUTE_NAME]);
    }
}