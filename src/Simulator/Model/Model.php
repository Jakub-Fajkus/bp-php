<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class Model
 */
class Model implements ModelInterface
{
    /**
     * @var ModelXmlInterface
     */
    private $xml;

    /**
     * Motor drives for each motor of the model
     *
     * @var MotorDriveInterface[]
     */
    private $motorDrives;

    /**
     * Model constructor.
     *
     * @param ModelXmlInterface     $xml
     * @param MotorDriveInterface[] $motorDrives
     */
    public function __construct(ModelXmlInterface $xml, array $motorDrives)
    {
        $this->xml = $xml;
        $this->motorDrives = $motorDrives;
    }

    /**
     * Return the model xml object
     *
     * @return ModelXmlInterface
     */
    public function getModelXml(): ModelXmlInterface
    {
        return $this->xml;
    }

    /**
     * Return the model xml object
     *
     * @return MotorDriveInterface[]
     */
    public function getMotorDrives(): array
    {
        return $this->motorDrives;
    }
}
