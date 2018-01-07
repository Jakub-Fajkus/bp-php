<?php
declare(strict_types=1);

namespace Simulator\Serializer\Model;

use Simulator\Model\ModelXmlInterface;

/**
 * Interface ModelSerializerInterface
 * @package Simulator\Serializer
 */
interface ModelSerializerInterface
{
    /**
     * Serializes the model data to format, which is suitable for the simulator
     *
     * @param ModelXmlInterface $modelXml
     *
     * @return string
     */
    public function serialize(ModelXmlInterface $modelXml): string;
}
