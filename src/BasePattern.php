<?php
/**
 * Created by PhpStorm.
 * User: alive
 * Date: 9/18/18
 * Time: 3:38 PM
 */

namespace Alive2212\LaravelOnionPattern;

use Alive2212\LaravelSmartResponse\ResponseModel;
use Alive2212\LaravelSmartResponse\SmartResponse\SmartResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait BasePattern
{
    /**
     * @var
     */
    protected $paths;

    /**
     * @var
     */
    protected $response;

    /**
     * BasePattern constructor.
     */
    function __construct()
    {
        $this->response = new ResponseModel();
    }

    /**
     * @param array $path
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(array $path, Request $request): JsonResponse
    {
        if (count($path) > 0) {
            $className = $path[0][0];
            $methodName = $path[0][1];
            array_shift($path);
            $object = new $className();
            return $object->{$methodName}(
                $request,
                function () use ($path, $request) {
                    return $this->handler(
                        $path,
                        $request
                    );
                }
            );
        }
        $this->initDefaultResponse();
        return SmartResponse::response($this->response);
    }

    /**
     * initialize default response
     */
    public function initDefaultResponse()
    {
        //
    }

}