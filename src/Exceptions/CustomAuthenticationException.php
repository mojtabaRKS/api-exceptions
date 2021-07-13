<?php

namespace Mojtabarks\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Mojtabarks\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomAuthenticationException extends ApiExceptionAbstract
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
        $this->exception = $exception;
        parent::__construct($exception);
    }

    /**
     * @param $code
     * @return $this|CustomAuthenticationException
     */
    public function setCode($code = null): self
    {
        $this->code = ($code) ? $code : Response::HTTP_FORBIDDEN;
        return $this;
    }

    /**
     * @param $message
     * @return $this|CustomAuthenticationException
     */
    public function setMessage($message = null): self
    {
        $this->message = !empty($message) ? $message : trans('errors::errors.unauthenticated');
        return $this;
    }
}
