<?php

namespace PHPSTL\Test;


use PHPSTL\Model\Normal;
use PHPSTL\Model\STLModel;
use PHPSTL\Model\Vertex;
use PHPSTL\Reader\STLReader;

class BinnarySTLReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_properly_read_model_name()
    {
        $reader = STLReader::forFile(__DIR__ . '/stls/binnary.stl');
        $model = $reader->readModel();

        $this->assertEquals('3D_Systems_View_ship_stl', $model->name());
    }

    /**
     * @test
     */
    public function it_should_properly_read_facets()
    {
        $reader = STLReader::forFile(__DIR__ . '/stls/binnary.stl');
        $model = $reader->readModel();
        $facets = $model->getFacets();
        $this->assertCount(828, $facets);
        $testFacet = $facets[5];
        $testNormal = new Normal(0.00000000E+00, 1.00000000E+00, 0.00000000E+00);

        $testVertex = new Vertex(2.2289998531341553, 1.6720001697540283, 0.91099989414215088);
        $testVertex2 = new Vertex(3.4939999580383301, 1.6720001697540283, 0.94656670093536377);
        $testVertex3 = new Vertex(3.208751916885376, 1.6720001697540283, 0.66768538951873779);

        $this->assertEquals($testNormal, $testFacet->normal());
        $this->assertEquals($testVertex, $testFacet->v1());
        $this->assertEquals($testVertex2, $testFacet->v2());
        $this->assertEquals($testVertex3, $testFacet->v3());
    }
}
