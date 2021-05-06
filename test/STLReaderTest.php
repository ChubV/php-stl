<?php

namespace PHPSTL\Test;

use PHPSTL\Reader\STLReader;
use PHPUnit\Framework\TestCase;

class STLReaderTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_correct_reader()
    {
        $this->assertInstanceOf('PHPSTL\Reader\TextSTLReader',
            STLReader::forFile(__DIR__ . '/stls/text.stl'));
        $this->assertInstanceOf('PHPSTL\Reader\BinarySTLReader',
            STLReader::forFile(__DIR__ . '/stls/binary.stl'));
    }
}