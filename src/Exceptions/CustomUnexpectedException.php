<?php

namespace Liateam\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiException\Contracts\ApiException;

class CustomUnexpectedException extends ApiException
{
    /**
     * CustomUnexpectedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
