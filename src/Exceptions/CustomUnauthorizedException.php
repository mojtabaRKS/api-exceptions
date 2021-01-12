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
    public function setCode($code)
    {
        if ($code) {
            $this->code = $code;
            return $this;
        }

        $this->code = $this->exception->getCode() ?? Response::HTTP_FORBIDDEN;
        return $this;
    }

    /**
     * @param $message
     * @return $this|CustomUnauthorizedException
     */
    public function setMessage($message)
    {
        if ($message) {
            $this->message = $message;
            return $this;
        }

        $this->message = $this->exception->getMessage() ?? 'Unauthorized';
        return $this;
    }
}
