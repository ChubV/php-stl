<?php

namespace PHPSTL\test;


use PHPSTL\Handler\VolumeHandler;
use PHPSTL\Reader\STLReader;

class VolumeHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_calculate_volume()
    {
        $reader = STLReader::forFile(__DIR__ . '/stls/text.stl');
        $reader->setHandler(new VolumeHandler());

        $this->assertEquals(61.023744373000547, $reader->readModel());
    }
}
