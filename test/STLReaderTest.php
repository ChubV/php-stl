<?php
namespace PHPSTL\Test;

use PHPSTL\Reader\STLReader;

class STLReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_correct_reader()
    {
        $this->assertInstanceOf('PHPSTL\Reader\TextSTLReader',
            STLReader::forFile(__DIR__ . '/stls/text.stl'));
        $this->assertInstanceOf('PHPSTL\Reader\BinnarySTLReader',
            STLReader::forFile(__DIR__ . '/stls/binnary.stl'));
    }
}