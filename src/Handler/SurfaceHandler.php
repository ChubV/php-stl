<?php
namespace PHPSTL\Handler;

use PHPSTL\Model\Facet;
use PHPSTL\Model\Vertex;

/**
 * Handle surface calculations without STLModel composition to save some memory.
 *
 * @author Bogdan Morar (https://github.com/BogMor)
 */
class SurfaceHandler implements HandlerInterface
{
    private $surface;
    /** @var null|Vertex */
    private $ref;

    public function __construct()
    {
        $this->ref = null;
        $this->surface = 0.0;
    }


    public function onModelName($modelName)
    {
        // void
    }

    public function onFacet(Facet $facet)
    {
        $this->surface += $facet->area();
    }

    public function result()
    {
        return $this->surface;
    }
}