<?php

namespace App\Exceptions;

use Exception;
use Tools\JsonTools\JsonResponse;
use Tools\JsonTools\StringUtils;

/**
 * Class AuthorizeException
 * @package App\Exceptions
 * 认证相关的异常处理
 */
class AuthorizeException extends Exception
{

    /**
     * @param $request
     * @param Exception $exception
     * @return array
     */
    public function handle($request,Exception $exception) {
        return [
            'code' => 500,
            'message' => $exception->getMessage()
        ];
    }
}
