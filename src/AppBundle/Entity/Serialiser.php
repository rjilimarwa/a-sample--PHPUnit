<?php


namespace AppBundle\Entity;
namespace  JMS\Serialiser;
use Metadata\MetadataFactoryInterface;
use JMS\Serializer\Construction\ObjectConstructorInterface;
use PhpCollection\MapInterface;
use JMS\Serializer\EventDispatcher\EventDispatcherInterface;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\TypeParser;
use JMS\Serializer\Expression\ExpressionEvaluatorInterface;

/**
 * Class Serialiser
 * @package JMS\Serialiser
 */
class Serialiser

{
    /**
     * Serialiser constructor.
     * @param MetadataFactoryInterface $factory
     * @param HandlerRegistryInterface $handlerRegistry
     * @param ObjectConstructorInterface $objectConstructor
     * @param MapInterface $serializationVisitors
     * @param MapInterface $deserializationVisitors
     * @param EventDispatcherInterface|null $dispatcher
     * @param TypeParser|null $typeParser
     * @param ExpressionEvaluatorInterface|null $expressionEvaluator
     */

    public function __construct(

        MetadataFactoryInterface $factory,
        HandlerRegistryInterface $handlerRegistry,
        ObjectConstructorInterface $objectConstructor,
        MapInterface $serializationVisitors,
        MapInterface $deserializationVisitors,
        EventDispatcherInterface $dispatcher = null,
        TypeParser $typeParser = null,
        ExpressionEvaluatorInterface $expressionEvaluator = null
    )
    {

    }
}