<?php
namespace PHPSTL\Model;

class Facet
{
    /**
     * @var Normal
     */
    private $normal;
    /**
     * @var Vertex
     */
    private $v1;
    /**
     * @var Vertex
     */
    private $v2;
    /**
     * @var Vertex
     */
    private $v3;

    public function __construct(Normal $normal, Vertex $v1, Vertex $v2, Vertex $v3)
    {

        $this->normal = $normal;
        $this->v1 = $v1;
        $this->v2 = $v2;
        $this->v3 = $v3;
    }

    public function normal()
    {
        return $this->normal;
    }
    
    public function v1()
    {
        return $this->v1;
    }
    
    public function v2()
    {
        return $this->v2;
    }
    
    public function v3()
    {
        return $this->v3;
    }

    public function area()
    {
        $c00 = $this->v1()->y() * $this->v2()->z() - $this->v1()->z() * $this->v2()->y();
        $c01 = $this->v1()->z() * $this->v2()->x() - $this->v1()->x() * $this->v2()->z();
        $c02 = $this->v1()->x() * $this->v2()->y() - $this->v1()->y() * $this->v2()->x();

        $c10 = $this->v2()->y() * $this->v3()->z() - $this->v2()->z() * $this->v3()->y();
        $c11 = $this->v2()->z() * $this->v3()->x() - $this->v2()->x() * $this->v3()->z();
        $c12 = $this->v2()->x() * $this->v3()->y() - $this->v2()->y() * $this->v3()->x();

        $c20 = $this->v3()->y() * $this->v1()->z() - $this->v3()->z() * $this->v1()->y();
        $c21 = $this->v3()->z() * $this->v1()->x() - $this->v3()->x() * $this->v1()->z();
        $c22 = $this->v3()->x() * $this->v1()->y() - $this->v3()->y() * $this->v1()->x();


        $sum0 = $c00 + $c10 + $c20;
	    $sum1 = $c01 + $c11 + $c21;
	    $sum2 = $c02 + $c12 + $c22;

        $n = Normal::forTriangle($this->v1(), $this->v2(), $this->v3());

	    $area = 0.5 * ($n->x() * $sum0 + $n->y() * $sum1 + $n->z() * $sum2);

        return $area;
    }
}