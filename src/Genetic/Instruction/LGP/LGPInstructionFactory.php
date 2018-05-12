<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;

use Config\Config;
use Genetic\Instruction\InstructionFactoryInterface;
use Genetic\Instruction\InstructionInterface;

/**
 * Class LGPInstructionFactory
 * @package Genetic\Instruction\LGP
 */
class LGPInstructionFactory implements InstructionFactoryInterface
{

    /**
     * Randomizes an instruction
     *
     * @return InstructionInterface
     */
    public function createRandomInstruction(int $index): InstructionInterface
    {
        return new SreInstruction(Config::getRandomSourceRegisterIndex(), Config::getRandomDestinationIndex());
    }
}
