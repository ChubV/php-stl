<?php

namespace PHPSTL\Handler;


use PHPSTL\Model\Facet;
use PHPSTL\Model\STLModel;

class STLModelHandler implements HandlerInterface
{
    /** @var STLModel */
    private $model;

    public function onModelName($modelName)
    {
        $this->model = new STLModel($modelName);
    }

    public function onFacet(Facet $facet)
    {
        $this->model->addFacet($facet);
    }

    public function result()
    {
        return $this->model;
    }
}