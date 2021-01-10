<?php

namespace Liateam\ApiExceptions\Exceptions;

use Illuminate\Http\Response;
use Liateam\ApiException\Contracts\ApiException;
use Throwable;

class CustomNotFoundHttpException extends ApiException
{
    /**
     * CustomNotFoundHttpException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = Response::HTTP_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
