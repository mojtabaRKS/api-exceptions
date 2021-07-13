<?php

namespace Mojtabarks\ApiExceptions\Exceptions;

use Mojtabarks\ApiExceptions\Contracts\ApiExceptionAbstract;
use Illuminate\Http\Response;
use Throwable;

class CustomMethodNotAllowed extends ApiExceptionAbstract
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
     * @return self
     */
    public function setCode($code = null)
    {
        $this->code = $code ? $code : Response::HTTP_METHOD_NOT_ALLOWED;
        return $this;
    }

    /**
     * @param $message
     * @return string
     */
    public function setMessage($message = null)
    {
        $this->message = !empty($message) ? $message : trans('errors.method_not_allowed');
        return $this;
    }
}
