<?php
namespace PHPSTL\Handler;

use PHPSTL\Model\Facet;
use PHPSTL\Model\Vertex;

/**
 * Handle volume calculations without STLModel composition to save some memory.
 */
class VolumeHandler implements HandlerInterface
{
    private $volume;
    /** @var null|Vertex */
    private $ref;

    public function __construct()
    {
        $this->ref = null;
        $this->volume = 0.0;
    }


    public function onModelName($modelName)
    {
        // void
    }

    public function onFacet(Facet $facet)
    {
        if (!$this->ref) {
            $this->ref = $facet->v1();
        }

        $px = $facet->v1()->x() - $this->ref->x();
        $py = $facet->v1()->y() - $this->ref->y();
        $pz = $facet->v1()->z() - $this->ref->z();
        $n = $facet->normal();
        $height = ($n->x() * $px) + ($n->y() * $py) + ($n->z() * $pz);
        $area = $facet->area();
        $this->volume += ($area * $height) / 3.0;
    }

    public function result()
    {
        return $this->volume;
    }
}