<?php
namespace PHPSTL\Handler;

use PHPSTL\Model\Facet;
use PHPSTL\Model\Vertex;

/**
 * Handle Dimensions calculations without STLModel composition to save some memory.
 *
 * @author Bogdan Morar (https://github.com/BogMor)
 */
class DimensionsHandler implements HandlerInterface
{

    private $dimensions;

    /** @var null|Vertex */
    private $stats;

    public function __construct()
    {
        $this->stats = null;
        $this->dimensions = array();
    }

    private function STL_MAX($A, $B)
    {
        return ($A > $B) ? $A : $B;
    }

    private function STL_MIN($A, $B)
    {
        return ($A < $B) ? $A : $B;
    }

    public function onModelName($modelName)
    {
        // void
    }

    // this function will set the min/max
    public function onFacet(Facet $facet)
    {
        if (!$this->stats) {
            $this->stats["min"]["x"] = $facet->v1()->x();
            $this->stats["min"]["y"] = $facet->v1()->y();
            $this->stats["min"]["z"] = $facet->v1()->z();
            $this->stats["max"]["x"] = $facet->v1()->x();
            $this->stats["max"]["y"] = $facet->v1()->y();
            $this->stats["max"]["z"] = $facet->v1()->z();
        }

        for ($j = 1; $j <= 3; $j++) {
            $functionName = "v" . $j;
            $vertex = $facet->$functionName();
            $this->stats["min"]["x"] = $this->STL_MIN($this->stats["min"]["x"], $vertex->x());
            $this->stats["min"]["y"] = $this->STL_MIN($this->stats["min"]["y"], $vertex->y());
            $this->stats["min"]["z"] = $this->STL_MIN($this->stats["min"]["z"], $vertex->z());
            $this->stats["max"]["x"] = $this->STL_MAX($this->stats["max"]["x"], $vertex->x());
            $this->stats["max"]["y"] = $this->STL_MAX($this->stats["max"]["y"], $vertex->y());
            $this->stats["max"]["z"] = $this->STL_MAX($this->stats["max"]["z"], $vertex->z());
        }
    }

    public function result()
    {
        $result = new \stdClass();
        $result->length = $this->stats["max"]["x"] - $this->stats["min"]["x"];
        $result->width = $this->stats["max"]["y"] - $this->stats["min"]["y"];
        $result->height = $this->stats["max"]["z"] - $this->stats["min"]["z"];
        $result->bounding_diameter = sqrt(
            pow($result->width, 2) + pow($result->length, 2) + pow($result->height, 2)
        );
        return $result;
    }
}
