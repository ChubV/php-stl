<?php
namespace PHPSTL\Model;


class Normal extends Vertex
{
    public function normalize()
    {
        $length = sqrt((double)$this->x() * (double)$this->x() +
            (double)$this->y() * (double)$this->y() +
            (double)$this->z() * (double)$this->z());
        if ($length < 0.000000000001) {
            $this->x = 1.0;
            $this->y = 0.0;
            $this->z = 0.0;

            return;
        }
        $factor = 1.0 / $length;
        $this->x *= $factor;
        $this->y *= $factor;
        $this->z *= $factor;
    }

    public static function forTriangle(Vertex $v1, Vertex $v2, Vertex $v3)
    {
        $v10 = $v2->x() - $v1->x();
        $v11 = $v2->y() - $v1->y();
        $v12 = $v2->z() - $v1->z();
        $v20 = $v3->x() - $v1->x();
        $v21 = $v3->y() - $v1->y();
        $v22 = $v3->z() - $v1->z();

        $nx = (float)((double)$v11 * (double)$v22) - ((double)$v12 * (double)$v21);
        $ny = (float)((double)$v12 * (double)$v20) - ((double)$v10 * (double)$v22);
        $nz = (float)((double)$v10 * (double)$v21) - ((double)$v11 * (double)$v20);

        $res = new self($nx, $ny, $nz);
        $res->normalize();

        return $res;
    }
}