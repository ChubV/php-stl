<?php
namespace PHPSTL\Handler;

use PHPSTL\Model\Facet;
use PHPSTL\Model\Vertex;

/**
 * Handle size calculations without STLModel composition to save some memory.
 */
class SizeHandler implements HandlerInterface
{
    private $min;
    private $max;
    private $ref;

    public function __construct()
    {
        $this->min = ['x' => 0, 'y' => 0, 'z' => 0];
        $this->max = ['x' => 0, 'y' => 0, 'z' => 0];
    }


    public function onModelName($modelName)
    {
        // void
    }

    public function onFacet(Facet $facet)
    {
        if($this->min['x'] > $facet->v1()->x()){
            $this->min['x'] = $facet->v1()->x();
        }
        if($this->min['y'] > $facet->v1()->y()){
            $this->min['y'] = $facet->v1()->y();
        }
        if($this->min['z'] > $facet->v1()->z()){
            $this->min['z'] = $facet->v1()->z();
        }
        if($this->max['x'] < $facet->v1()->x()){
            $this->max['x'] = $facet->v1()->x();
        }
        if($this->max['y'] < $facet->v1()->y()){
            $this->max['y'] = $facet->v1()->y();
        }
        if($this->max['z'] < $facet->v1()->z()){
            $this->max['z'] = $facet->v1()->z();
        }
    }

    public function result()
    {
        $return = [];
        $return['x'] = round(abs($this->min['x']) + abs($this->max['x']),1);
        $return['y'] = round(abs($this->min['y']) + abs($this->max['y']),1);
        $return['z'] = round(abs($this->min['z']) + abs($this->max['z']),1);
        return $return;
    }
}
