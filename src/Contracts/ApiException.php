<?php

namespace Liateam\ApiException\Contracts;

use Exception;
use Liateam\ApiResponse\Contracts\ResponseContract;
use \Throwable;
use JetBrains\PhpStorm\Pure;
use \Illuminate\Http\JsonResponse;
use Liateam\ApiResponse\Responses\FailureResponse;

abstract class ApiException extends Exception
{
    /**
     * failureResponse injected instance
     *
     * @var FailureResponse $failureResponse
     */
    private $failureResponse;

    /**
     * ApiException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->failureResponse = new FailureResponse($code, $message);
        $this->message = $message;
        $this->code = $code;
        $this->previous = $previous;
        parent::__construct($message, $code, $previous);
    }

    /**
     * renders the error for api
     *
     * @return ResponseContract
     */
    public function render()
    {
        $debugMode = env('APP_DEBUG') ?? false;

        $response = $this->failureResponse
            ->setMessage($this->message)
            ->setCode($this->code);

        // if the application is in debug mode ,
        // so attach errors and stack trace to response and return it.
        if ($debugMode) {
            $response = $response
                ->setError([
                    'previous' => $this->previous,
                    'trace' => $this->getTrace(),
                    'line' => $this->getLine(),
                ]);
        }

        return $response->render();
    }
}
