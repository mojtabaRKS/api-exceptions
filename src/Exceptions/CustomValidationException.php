<?php

namespace Liateam\ApiExceptions\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;

class CustomValidationException extends ApiExceptionAbstract
{
    /**
     * @var Throwable $exception
     */
    public $exception;

    /**
     * CustomAuthenticationException constructor.
     * @param $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
        parent::__construct($exception);
        $this->setErrors();
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code): self
    {
    
        $this->code = ($code) ? $code : Response::HTTP_UNPROCESSABLE_ENTITY;
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        if ($message) {
            $this->message = $message;
            return $this;
        }

        $this->message = $this->exception->getMessage() ?? 'Validation Exception';
        return $this;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors($errors = [])
    {
        if (! is_array($errors)) {
            $errors = [$errors];
        }

        $this->errors = array_merge($this->exception->validator->getMessageBag()->messages(), $errors);
        return $this;
    }
}
