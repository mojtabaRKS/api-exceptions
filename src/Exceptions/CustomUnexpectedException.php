<?php

namespace Liateam\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomUnexpectedException extends ApiExceptionAbstract
{
    /**
     * CustomUnexpectedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $exception)
    {
        parent::__construct($exception);
    }
}
