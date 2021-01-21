<?php

namespace Mojtabarks\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Mojtabarks\ApiExceptions\Contracts\ApiExceptionAbstract;

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
        $this->exception = $exception;
    }

    /**
     * @param $code
     * @return $this|CustomUnauthorizedException
     */
    public function setCode($code = null)
    {
        $this->code = $code ? $code : Response::HTTP_INTERNAL_SERVER_ERROR;
        return $this;
    }

    /**
     * @param $message
     * @return $this|CustomUnauthorizedException
     */
    public function setMessage($message = null)
    {
        $this->message = !empty($message) ? $message : 'Unexpected Exception';
        return $this;
    }
}
