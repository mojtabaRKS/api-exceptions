<?php

namespace Mojtabarks\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Mojtabarks\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomQueryException extends ApiExceptionAbstract
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
        $this->code = Response::HTTP_INTERNAL_SERVER_ERROR;
        return $this;
    }

    /**
     * @param $message
     * @return $this|CustomAuthenticationException
     */
    public function setMessage($message = null): self
    {
        $this->message = (!empty($message) && $this->debugMode()) ? $message : trans('errors.default');
        return $this;
    }
}
