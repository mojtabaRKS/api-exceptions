<?php

namespace Liateam\ApiExceptions\Exceptions;

use Illuminate\Http\Response;
use Liateam\ApiException\Contracts\ApiException;

class CustomDefaultException extends ApiException
{
    /**
     * CustomAuthenticationException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = Response::HTTP_UNPROCESSABLE_ENTITY, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
