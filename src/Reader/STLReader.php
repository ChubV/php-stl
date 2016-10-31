<?php

namespace PHPSTL\Reader;

class STLReader
{
    const BINARY = 1;
    const TEXT = 2;

    /**
     * @param $fileName
     * @return BaseSTLReader
     */
    public static function forFile($fileName)
    {
        $handle = fopen($fileName, 'rb');
        $type = self::getSTLType($handle);
        $fileReader = ($type == self::TEXT) ? new TextSTLReader($handle) : new BinnarySTLReader($handle);

        return $fileReader;
    }

    private static function getSTLType($handle)
    {
        $type = self::BINARY;
        if (strtolower(fread($handle, 5)) == 'solid') {
            $type = self::TEXT;
        }
        rewind($handle);

        return $type;
    }
}