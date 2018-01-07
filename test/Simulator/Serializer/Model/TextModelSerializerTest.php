<?php
declare(strict_types=1);

namespace Test\Simulator\Serializer\Model;

use PHPUnit\Framework\TestCase;

/**
 * Class TextModelSerializerTest
 */
class TextModelSerializerTest extends TestCase
{
    public function testItSerializesFixedModelXml()
    {
        $modelXml = new \Simulator\Model\FixedModelXml();

        $serializer = new \Simulator\Serializer\Model\TextModelSerializer();

        $result = $serializer->serialize($modelXml);

        static::assertEquals(
            $modelXml->getAsString(),
            $result
        );
    }
}
