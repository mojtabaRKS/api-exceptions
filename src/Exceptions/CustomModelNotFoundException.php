<?php

namespace Mojtabarks\ApiExceptions\Exceptions;

use Illuminate\Http\Response;
use Mojtabarks\ApiExceptions\Contracts\ApiExceptionAbstract;
use Throwable;

class CustomModelNotFoundException extends ApiExceptionAbstract
{
    /**
     * @var Throwable
     */
    public $exception;

    /**
     * CustomAuthenticationException constructor.
     *
     * @param $exception
     */
    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
        parent::__construct($exception);
    }

    /**
     * @param $code
     *
     * @return self
     */
    public function setCode($code = null)
    {
        $this->code = $code ? $code : Response::HTTP_NOT_FOUND;

        return $this;
    }

    /**
     * @param $message
     *
     * @return string
     */
    public function setMessage($message = null)
    {
        $this->message = trans('errors::errors.model_not_found');
        return $this;
    }
}
