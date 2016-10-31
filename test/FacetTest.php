<?php

namespace PHPSTL\test;

use PHPSTL\Model\Facet;
use PHPSTL\Model\Normal;
use PHPSTL\Model\Vertex;

class FacetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_calculate_area()
    {
        $v1 = new Vertex(0, 0, 0);
        $v2 = new Vertex(1, 0, 0);
        $v3 = new Vertex(1, 1, 0);

        $facet = new Facet(new Normal(0,0,1), $v1, $v2, $v3);

        $this->assertEquals(0.5, $facet->area());
    }
}
