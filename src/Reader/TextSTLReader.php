<?php
namespace PHPSTL\Reader;

use PHPSTL\Exceptions\InvalidFileFormatException;
use PHPSTL\Model\Facet;
use PHPSTL\Model\Normal;
use PHPSTL\Model\Vertex;

class TextSTLReader extends BaseSTLReader
{
    /** @return string ModelName */
    protected function readModelName()
    {
        preg_match('/solid\s+([\w]+)/i', $this->readNextLine(), $parts);
        $name = $parts[1];

        return $name;
    }

    /** @return Facet|null */
    protected function getNextFacet()
    {
        if (feof($this->handle)
            || !preg_match('/facet\s+normal\s+([0-9\.\-\+E]+)\s+([0-9\.\-\+E]+)\s+([0-9\.\-\+E]+)\s*/i', $this->readNextLine(), $parts)) {
            return null;
        }

        $normal = new Normal($parts[1], $parts[2], $z = $parts[3]);

        $this->readNextLine(); // OUTER LOOP skip
        $v1 = $this->readVertex();
        $v2 = $this->readVertex();
        $v3 = $this->readVertex();

        $this->readNextLine(); // ENDLOOP skip
        $this->readNextLine(); // ENDFACET skip

        return new Facet($normal, $v1, $v2, $v3);
    }

    /** @return string
     */
    protected function readNextLine()
    {
        return fgets($this->handle, 2048);
    }

    private function readVertex()
    {
        if (feof($this->handle)
            || !preg_match('/vertex\s+([0-9\.\-\+E]+)\s+([0-9\.\-\+E]+)\s+([0-9\.\-\+E]+)\s*/i',
                $this->readNextLine(), $parts)) {
            throw new InvalidFileFormatException('Can\'t find vertex declaration');
        }

        return new Vertex($parts[1], $parts[2], $parts[3]);
    }
}