<?php

namespace Liateam\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomUnauthorizedException extends ApiExceptionAbstract
{
    /**
     * @var Throwable $exception
     */
    public $exception;

    /**
     * CustomAuthenticationException constructor.
     * @param $exception
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
        $this->code = $code ? $code : Response::HTTP_FORBIDDEN;
        return $this;
    }

    /**
     * @param $message
     * @return $this|CustomUnauthorizedException
     */
    public function setMessage($message = null)
    {
        $this->message = !empty($message) ? $message : 'Unauthorized';
        return $this;
    }
}
