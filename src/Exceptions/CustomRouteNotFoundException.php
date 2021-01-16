<?php

namespace Liateam\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomRouteNotFoundException extends ApiExceptionAbstract
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
     * @return self
     */
    public function setCode($code = null)
    {
        $this->code = $code ? $code : Response::HTTP_NOT_FOUND;
        return $this;
    }

    /**
     * @param $message
     * @return self
     */
    public function setMessage($message = null)
    {
        $this->message = !empty($message) ? $message : 'Route not found';
        return $this;
    }
}
