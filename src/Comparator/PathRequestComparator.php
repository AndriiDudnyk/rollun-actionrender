<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.02.17
 * Time: 14:49
 */

namespace rollun\actionrender\Comparator;

use Psr\Http\Message\ServerRequestInterface as Request;

class PathRequestComparator implements RequestComparatorInterface
{
    public function __invoke(Request $request, $pattern)
    {
        $path = $request->getUri()->getPath();
        return preg_match($pattern, $path);
    }
}
