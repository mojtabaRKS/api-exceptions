<?php

namespace Mojtabarks\ApiExceptions\Exceptions;

use Illuminate\Http\Response;
use Mojtabarks\ApiExceptions\Contracts\ApiExceptionAbstract;
use Throwable;

class CustomRouteNotFoundException extends ApiExceptionAbstract
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
        parent::__construct($exception);
        $this->exception = $exception;
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
     * @return self
     */
    public function setMessage($message = null)
    {
        $this->message = !empty($message) ? $message : trans('errors::errors.route_not_found');
        return $this;
    }
}
