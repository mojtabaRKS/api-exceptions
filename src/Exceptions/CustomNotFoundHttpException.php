<?php

namespace Mojtabarks\ApiExceptions\Exceptions;

use Illuminate\Http\Response;
use Mojtabarks\ApiExceptions\Contracts\ApiExceptionAbstract;
use Throwable;

class CustomNotFoundHttpException extends ApiExceptionAbstract
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
     * @param null $code
     *
     * @return CustomNotFoundHttpException
     */
    public function setCode($code = null)
    {
        $this->code = $code ? $code : Response::HTTP_NOT_FOUND;

        return $this;
    }

    /**
     * @param null $message
     *
     * @return $this|CustomNotFoundHttpException
     */
    public function setMessage($message = null)
    {
        $this->message = !empty($message) ? $message : trans('errors::errors.not_found');
        return $this;
    }
}
