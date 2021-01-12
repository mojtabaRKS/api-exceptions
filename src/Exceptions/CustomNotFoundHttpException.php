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
     * @return int
     */
    public function setCustomCode(): int
    {
        return $this->exception->getCode() ?? Response::HTTP_FORBIDDEN;
    }

    /**
     * @return string
     */
    public function setCustomMessage(): string
    {
        return $this->exception->getMessage() ?? 'Not Found';
    }
}
