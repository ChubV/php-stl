<?php
namespace PHPSTL\Reader;

use PHPSTL\Exceptions\InvalidFileFormatException;
use PHPSTL\Model\Facet;
use PHPSTL\Model\Normal;
use PHPSTL\Model\Vertex;

class BinnarySTLReader extends BaseSTLReader
{
    /** @return string ModelName */
    protected function readModelName()
    {
        $line = fread($this->handle, 84);
        $parts = unpack('a80name/Iint', $line);
        $name = $parts['name'];
        $name = trim($name, "\x00 \t\n\r");

        return trim(preg_replace('/[^_a-zA-Z0-9]+/', '_', $name), '_');
    }

    /** @return Facet|null */
    protected function getNextFacet()
    {
        $facetData = fread($this->handle, 50);
        if (strlen($facetData) != 50) {
            if (feof($this->handle)) {
                return null;
            }
            throw new InvalidFileFormatException(sprintf('It should be 50 bytes of facet data. %d got', strlen($facetData)));
        }
        $parts = unpack('f12/x2', $facetData);
        $normal = new Normal($parts[1], $parts[2], $parts[3]);
        $v1 = new Vertex($parts[4], $parts[5], $parts[6]);
        $v2 = new Vertex($parts[7], $parts[8], $parts[9]);
        $v3 = new Vertex($parts[10], $parts[11], $parts[12]);

        return new Facet($normal, $v1, $v2, $v3);
    }
}