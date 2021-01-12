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
        if ($code) {
            $this->code = $code;
            return $this;
        }

        $this->code = $this->exception->getCode() ?? Response::HTTP_UNPROCESSABLE_ENTITY;
        return $this;
    }

    /**
     * @param $message
     * @return CustomDefaultException
     */
    public function setMessage($message = null): self
    {
        if ($message) {
            $this->message = $message;
            return $this;
        }

        $this->message = $this->exception->getMessage() ?? 'Whoops! something went wrong!';
        return $this;
    }
}
