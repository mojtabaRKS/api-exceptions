<?php

namespace Liateam\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiException\Contracts\ApiException;

class CustomValidationException extends ApiException
{
    /**
     * CustomValidationException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = Response::HTTP_UNPROCESSABLE_ENTITY, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
