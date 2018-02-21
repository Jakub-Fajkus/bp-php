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


        $random = random_int(0, 3);
        $instruction = null;

        switch ($random) {
            case 0:
                $instruction = new DecInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
                break;
            case 1:
                $instruction = new IncInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
                break;
            case 2:
                $instruction = new SouInstruction(Config::getRandomRegisterIndex(), (int)Config::getRandomMotorId());
                break;
            case 3:
                $instruction = new SreInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
                break;
        }

        return $instruction;
    }

    public function createInst($)
    {

    }
}
