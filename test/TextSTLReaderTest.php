<?php
namespace PHPSTL\Test;


use PHPSTL\Model\Normal;
use PHPSTL\Model\Vertex;
use PHPSTL\Reader\STLReader;

class TextSTLReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_properly_read_model_name()
    {
        $reader = STLReader::forFile(__DIR__ . '/stls/text.stl');
        $model = $reader->readModel();

        $this->assertEquals('Untitled1', $model->name());
    }

    /**
     * @test
     */
    public function it_should_properly_read_facets()
    {
        $reader = STLReader::forFile(__DIR__ . '/stls/text.stl');
        $model = $reader->readModel();
        $facets = $model->getFacets();
        $this->assertCount(12, $facets);
        $testFacet = $facets[5];
        $testNormal = new Normal(-1.00000000E+00, 0.00000000E+00, 0.00000000E+00);

        $testVertex = new Vertex(-1.96850394E+00, -1.96850394E+00, 1.96850394E+00);
        $testVertex2 = new Vertex(-1.96850394E+00, 1.96850394E+00, 1.96850394E+00);
        $testVertex3 = new Vertex(-1.96850394E+00, 1.96850394E+00, -1.96850394E+00);

        $this->assertEquals($testNormal, $testFacet->normal());
        $this->assertEquals($testVertex, $testFacet->v1());
        $this->assertEquals($testVertex2, $testFacet->v2());
        $this->assertEquals($testVertex3, $testFacet->v3());
    }
}
