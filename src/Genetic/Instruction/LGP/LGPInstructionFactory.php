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


//        $random = random_int(0, 100);


//        if ($random < 10) {
//            return new IfscInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue(), IfscInstruction::getRandomOperator());
//        } elseif ($random < 20) {
//            return new IfsrInstruction(Config::getRandomRegisterIndex(), Config::getRandomRegisterIndex(), IfscInstruction::getRandomOperator());
//        } elseif ($random < 40) {
//            return new AddcInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
//        } elseif ($random < 75) {
//            return new AddrInstruction(Config::getRandomRegisterIndex(), Config::getRandomRegisterIndex());
//        } else {
//            return new SreInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
//        }

//        if ($random < 10) {
//            return new IfscInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue(), IfscInstruction::getRandomOperator());
//        } elseif ($random < 20) {
//            return new IfsrInstruction(Config::getRandomRegisterIndex(), Config::getRandomRegisterIndex(), IfscInstruction::getRandomOperator());
//        } else {
//            return new SreInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
//        }
    }
}
