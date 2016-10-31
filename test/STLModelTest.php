<?php
namespace PHPSTL\Test;

use PHPSTL\Model\Facet;
use PHPSTL\Model\Normal;
use PHPSTL\Model\STLModel;
use PHPSTL\Model\Vertex;
use PHPSTL\Reader\STLReader;

class STLModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_be_properly_init()
    {
        $model = new STLModel();

        $this->assertEquals(0, $model->volume());
        $this->assertEmpty(0, $model->getFacets());
    }

    /**
     * @test
     */
    public function it_should_add_facet()
    {
        $model = new STLModel();

        $this->assertEmpty(0, $model->getFacets());
        $model->addFacet(new Facet(new Normal(1, 1, 1), new Vertex(1, 1, 1), new Vertex(2, 2, 2), new Vertex(3, 4, 4)));
        $this->assertEmpty(0, $model->getFacets());
    }

    /**
     * @test
     */
    public function it_could_have_a_name()
    {
        $model = new STLModel('model_name');

        $this->assertEquals('model_name', $model->name());
    }

    /**
     * @test
     */
    public function it_should_calculate_stats()
    {
        $model = new STLModel();

        $model->addFacet(new Facet(new Normal(0, 100, 100), new Vertex(1, 1, 1),
            new Vertex(2, 2, 2), new Vertex(3, 4, 4)));
        $this->assertEquals(1, $model->minx());
        $this->assertEquals(1, $model->miny());
        $this->assertEquals(1, $model->minz());
        $this->assertEquals(3, $model->maxx());
        $this->assertEquals(4, $model->maxy());
        $this->assertEquals(4, $model->maxz());
        $model->addFacet(new Facet(new Normal(0, 100, 100), new Vertex(1, 1, 1),
            new Vertex(2, 2, 2), new Vertex(5, 6, 7)));
        $this->assertEquals(5, $model->maxx());
        $this->assertEquals(6, $model->maxy());
        $this->assertEquals(7, $model->maxz());

    }

    /**
     * @test
     */
    public function it_should_calculate_volume()
    {
        $model = STLReader::forFile(__DIR__ . '/stls/text.stl')->readModel();
        $this->assertEquals(61.023744373000547, $model->volume());
        $this->assertLessThanOrEqual(
            ($model->maxx() - $model->minx()) *
            ($model->maxy() - $model->miny()) *
            ($model->maxz() - $model->minz()), $model->volume()
        );
    }
}