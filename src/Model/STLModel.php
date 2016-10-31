<?php

namespace PHPSTL\Model;


class STLModel
{
    /** @var Facet[] */
    private $facets;
    private $name;
    private $minx;
    private $miny;
    private $minz;
    private $maxx;
    private $maxy;
    private $maxz;

    public function __construct($name = 'model')
    {
        $this->facets = [];
        $this->name = $name;
        $this->minx = null;
        $this->miny = null;
        $this->minz = null;
        $this->maxx = null;
        $this->maxy = null;
        $this->maxz = null;
    }

    public function name()
    {
        return $this->name;
    }

    /** @return Facet[] */
    public function getFacets()
    {
        return $this->facets;
    }

    public function addFacet(Facet $facet)
    {
        $this->facets[] = $facet;
        $this->calcStat($facet->v1());
        $this->calcStat($facet->v2());
        $this->calcStat($facet->v3());
    }

    public function minx()
    {
        return $this->minx;
    }

    public function miny()
    {
        return $this->miny;
    }

    public function minz()
    {
        return $this->minz;
    }

    public function maxx()
    {
        return $this->maxx;
    }

    public function maxy()
    {
        return $this->maxy;
    }

    public function maxz()
    {
        return $this->maxz;
    }

    public function volume()
    {
        $volume = 0.0;
        if (empty($this->facets)) {
            return 0.0;
        }
        $refP = $this->facets[0]->v1();

        foreach ($this->facets as $facet) {
            $px = $facet->v1()->x() - $refP->x();
		    $py = $facet->v1()->y() - $refP->y();
		    $pz = $facet->v1()->z() - $refP->z();
            /* Do dot product to get distance from point to plane */
            $n = $facet->normal();
            $height = ($n->x() * $px) + ($n->y() * $py) + ($n->z() * $pz);
            $area = $facet->area();
            $volume += ($area * $height) / 3.0;
        }

        return $volume;
    }

    private function calcStat(Vertex $v1)
    {
        if ($this->maxx !== null) {
            $this->maxx = max($this->maxx, $v1->x());
            $this->maxy = max($this->maxy, $v1->y());
            $this->maxz = max($this->maxz, $v1->z());
            $this->minx = min($this->minx, $v1->x());
            $this->miny = min($this->miny, $v1->y());
            $this->minz = min($this->minz, $v1->z());
        } else {
            $this->maxx = $this->minx = $v1->x();
            $this->maxy = $this->miny = $v1->y();
            $this->maxz = $this->minz = $v1->z();
        }
    }
}