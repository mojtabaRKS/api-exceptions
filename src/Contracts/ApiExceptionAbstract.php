<?php

namespace Liateam\ApiExceptions\Contracts;

use Exception;
use \Throwable;
use Liateam\ApiResponse\Responses\FailureResponse;
use Liateam\ApiResponse\Contracts\ResponseContract;

abstract class ApiExceptionAbstract extends Exception
{
    /**
     * @var Throwable
     */
    protected $exception;


    protected $errors = [];
    /**
     * @var FailureResponse
     */
    private $failureResponse;

    /**
     * ApiException constructor.
     * @param Throwable $exception
     */
    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
        parent::__construct($exception->getMessage(), $exception->getCode());
    }

    /**
     * renders the error for api
     *
     * @return ResponseContract
     */
    public function render()
    {
        $response = new FailureResponse($this->getCode(), $this->getMessage());
        return $response
            ->setResponseKey('error')
            ->setResponseValue($this->getErrors());
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    /**
     * sett errors for response
     *
     * @param array $errors
     * @return self
     */
    public function setErrors($errors)
    {
        if (env('APP_DEBUG')) {
        
            $this->errors= [
                'trace' => $this->exception->getTrace(),
                'line' => $this->exception->getLine(),
            ];
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
