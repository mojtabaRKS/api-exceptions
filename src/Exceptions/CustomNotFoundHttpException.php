<?php

namespace Liateam\ApiExceptions\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomNotFoundHttpException extends ApiExceptionAbstract
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
     * @param null $code
     * @return CustomNotFoundHttpException
     */
    public function setCode($code = null)
    {
        if ($code) {
            $this->code = $code;
            return $this;
        }

        $this->code = $this->exception->getCode() ?? Response::HTTP_FORBIDDEN;
        return $this;
    }

    /**
     * @param null $message
     * @return $this|CustomNotFoundHttpException
     */
    public function setMessage($message = null)
    {
        if ($message) {
            $this->message = $message;
            return $this;
        }

        $this->message = $this->exception->getMessage() ?? 'Not Found';
        return $this;
    }
}
