<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class MotorDrive
 * @package Simulator\Model
 */
class MotorDrive implements MotorDriveInterface
{
    /** @var string */
    private $motorName;

    /** @var int[] */
    private $values;

    /**
     * MotorDrive constructor.
     *
     * @param string $motorName
     * @param int[]  $values
     */
    public function __construct(string $motorName, array $values)
    {
        $this->motorName = $motorName;
        $this->values = $values;
    }

    /**
     * Convert the motor drive to array of integers
     *
     * @return int[]
     */
    public function getAsArray(): array
    {
//        $this->antiAlias();
//        $this->ensurePeriodicity();

        return $this->values;
    }

    /**
     * Anti aliases the values.
     *
     * This smooths the big differences between the values
     */
    private function antiAlias(): void
    {
        $newOnes = [];

        for ($i = 0, $iMax = \count($this->values); $i < $iMax - 1; $i++) { //-1 = skip the last value
            //add the current value
            $newOnes[] = $this->values[$i];

            //add the average of this and the next value
            $newOnes[] = (int)(($this->values[$i] + $this->values[$i+1]) / 2);
        }

        //add the last value
        $newOnes[] = $this->values[$iMax-1];

        //set the new values
        $this->values = $newOnes;
    }

    /**
     * Add the final number to the end of the values to ensure the periodicity of the controll
     */
    private function ensurePeriodicity(): void
    {
        $sum = array_sum($this->values);

        //ensure that the sum of the values is 0
        $this->values[] = -$sum;
    }

    /**
     * Get the motor name
     *
     * @return string
     */
    public function getMotorName(): string
    {
        return $this->motorName;
    }
}
