<?php

namespace PHPSTL\Model;

use PHPSTL\Exceptions\InvalidArgumentException;

class Vertex
{
    protected $x;
    protected $y;
    protected $z;

    public function __construct($x, $y, $z)
    {
        if (!is_numeric($x) || !is_numeric($y) || !is_numeric($z)) {
            throw new InvalidArgumentException('Coordinate should be numeric');
        }
        $this->x = (float)$x;
        $this->y = (float)$y;
        $this->z = (float)$z;
    }

    public function x()
    {
        return $this->x;
    }

    public function y()
    {
        return $this->y;
    }

    public function z()
    {
        return $this->z;
    }
}