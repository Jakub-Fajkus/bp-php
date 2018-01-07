<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Interface ModelInterface
 * @package Simulator\Model
 */
interface ModelInterface
{
    /**
     * Return the model xml object
     *
     * @return ModelXmlInterface
     */
    public function getModelXml() : ModelXmlInterface;


    /**
     * Return the model xml object
     *
     * @return MotorDriveInterface[]
     */
    public function getMotorDrives(): array;
}
