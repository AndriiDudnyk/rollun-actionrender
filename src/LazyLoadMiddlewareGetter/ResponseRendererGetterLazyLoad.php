<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.03.17
 * Time: 12:55
 */

namespace rollun\actionrender\LazyLoadMiddlewareGetter;

use Psr\Http\Message\ServerRequestInterface as Request;
use rollun\actionrender\Interfaces\LazyLoadMiddlewareGetterInterface;

class ResponseRendererGetterLazyLoad implements LazyLoadMiddlewareGetterInterface
{
    /**
     * [
     *  $key //-> pattern
     *      => $value, //-> middlewareServiceName
     * ]
     * @var array
     */
    protected $acceptTypesPattern;


    public function __construct(array $acceptTypesPattern)
    {
        $this->acceptTypesPattern = $acceptTypesPattern;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getLazyLoadMiddlewares(Request $request)
    {
        $accept = $request->getHeaderLine('Accept');

        foreach ($this->acceptTypesPattern as $acceptTypePattern => $middlewareService) {
            if (preg_match($acceptTypePattern, $accept)) {
                return [ $middlewareService ];
            }
        }
        return [];
    }
}
