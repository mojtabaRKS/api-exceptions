<?php

namespace Mojtabarks\ApiExceptions\Contracts;

use Exception;
use Mojtabarks\ApiResponse\Contracts\ResponseContract;
use Mojtabarks\ApiResponse\Responses\FailureResponse;
use Throwable;

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
     *
     * @param Throwable $exception
     */
    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
        parent::__construct($exception->getMessage(), $exception->getCode());
    }

    /**
     * renders the error for api.
     *
     * @return ResponseContract
     */
    public function render()
    {
        $this->setCode($this->exception->getCode());
        $this->setMessage($this->exception->getMessage());
        $this->SetErrors();
        $response = new FailureResponse($this->getCode(), $this->getMessage());

        return $response
            ->setResponseKey('error')
            ->setResponseValue($this->getErrors())
            ->render();
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setErrors($errors = [])
    {
        if (!is_array($errors)) {
            $errors = [$errors];
        }

        $this->errors = array_merge($errors, $this->errors);

        if (env('APP_DEBUG')) {
            $this->errors = array_merge([
                'trace' => $this->exception->getTrace(),
                'line'  => $this->exception->getLine(),
            ], $this->errors);
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
