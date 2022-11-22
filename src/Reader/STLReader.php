<?php

namespace PHPSTL\Reader;

class STLReader
{
    const BINARY = 1;
    const TEXT = 2;

    /**
     * @param string $fileName
     * @return BaseSTLReader
     */
    public static function forFile($fileName)
    {
        $handle = fopen($fileName, 'rb');
        $type = self::getSTLType($handle);
        $fileReader = ($type == self::TEXT) ? new TextSTLReader($handle) : new BinarySTLReader($handle);

        return $fileReader;
    }

    private static function getSTLType($handle)
    {
        $type = self::TEXT;
        if (strtolower(fread($handle, 5)) != 'solid' || self::binaryHasExpectedLength($handle)) {
            $type = self::BINARY;
        }
        rewind($handle);

        return $type;
    }

    private static function binaryHasExpectedLength($handle)
    {
        $fileSize = fstat($handle)['size'];
        fseek($handle, 80, SEEK_SET);
        $triangleCount = unpack('V', fread($handle, 4))[1];
        $sizeOfBinaryTriangleData = 50;
        $expectedSize = $sizeOfBinaryTriangleData * $triangleCount + 84;
        rewind($handle);
        return $expectedSize === $fileSize;
    }
}
