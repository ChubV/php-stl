<?php

namespace PHPSTL\Handler;


use PHPSTL\Model\Facet;

interface HandlerInterface
{
    public function onModelName($modelName);
    public function onFacet(Facet $facet);
    public function result();
}