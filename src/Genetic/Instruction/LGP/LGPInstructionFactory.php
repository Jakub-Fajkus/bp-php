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
//        if ($index >= 0 && $index < 10) {
//            //init
//            $instruction = new SreInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
//        } else if ($index >= 10 && $index < 15) {
//            //event
//            $random = random_int(0, 1);
//            switch ($random) {
//                case 0:
//                    $instruction = new DecInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
//                    break;
//                case 1:
//                    $instruction = new IncInstruction(Config::getRandomRegisterIndex(), Config::getRandomMotorValue());
//                    break;
//            }
//        } else {
//            $instruction = new SouInstruction(Config::getRandomRegisterIndex(), (int)Config::getRandomMotorId());
//        }

        $instruction = new SovInstruction(Config::getRandomMotorValue(), (int)Config::getRandomMotorId());


        return $instruction;
    }
}
