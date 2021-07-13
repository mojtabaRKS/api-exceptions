<?php

namespace Mojtabarks\ApiExceptions\Contracts;

use Exception;
use \Throwable;
use Mojtabarks\ApiResponse\Responses\FailureResponse;
use Mojtabarks\ApiResponse\Contracts\ResponseContract;

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
        parent::__construct($exception->getMessage(), (int) $exception->getCode());
    }

    /**
     * renders the error for api
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
     * @return $this
     */
    public function setErrors($errors = [])
    {
        $this->errors = array_merge((array)$errors, $this->errors);

        if ($this->debugMode()) {
            $this->errors = array_merge([
                'trace' => $this->exception->getTrace(),
                'line' => $this->exception->getLine(),
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

    /**
     * check the application is in debug mode or not
     *
     * @return boolean
     */
    protected function debugMode(): bool
    {
        return config('app.debug');
    }
}
