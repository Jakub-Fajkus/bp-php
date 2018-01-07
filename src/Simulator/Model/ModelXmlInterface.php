<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Interface ModelXmlInterface
 *
 * @package Simulator\Model
 */
interface ModelXmlInterface
{
    /**
     * Returns the model xml as a string
     *
     * @return string
     */
    public function getAsString(): string;
}
