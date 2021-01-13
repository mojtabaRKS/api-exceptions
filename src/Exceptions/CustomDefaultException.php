<?php

namespace Liateam\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomDefaultException extends ApiExceptionAbstract
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
     * @return CustomDefaultException
     */
    public function setCode($code = null): self
    {
        $this->code = $code ? $code : Response::HTTP_INTERNAL_SERVER_ERROR;
        return $this;
    }

    /**
     * @param $message
     * @return CustomDefaultException
     */
    public function setMessage($message = null): self
    {
        $this->message = !empty($message) ? $message : 'Whoops! something went wrong!';
        return $this;
    }
}
