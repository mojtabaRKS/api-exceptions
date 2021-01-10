<?php

namespace Liateam\ApiExceptions\Handlers;

use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiResponse\Contracts\ResponseContract;
use Liateam\ApiExceptions\Exceptions\CustomDefaultException;

/**
 * The classic CoR (Chain of Responsibility) pattern declares a single role for objects that make up a
 * chain, which is a Handler. In our example, let's differentiate between
 * ApiException and a final application's handler, which is executed when a
 * request gets through all the exception objects.
 *
 * The base ApiException class declares an interface for linking middleware
 * objects into a chain.
 */
class ApiException
{
    /**
     * Subclasses must override this method to provide their own checks. A
     * subclass can fall back to the parent implementation if it can't process a
     * request.
     *
     * @param Throwable $exception
     * @return ResponseContract
     */
    public static function handle(Throwable $exception)
    {
        $customException = static::getCustomException($exception);
        $message = static::prepareMessage($exception);
        $code = static::prepareCode($exception);

        if (class_exists($customException)) {

            return (new $customException($message, $code))
                ->render();
        }

        return (new CustomDefaultException($message, $code))
            ->render();
    }

    /**
     * returns mapped laravel|lumen class with mapped custom class.
     *
     * @param $exception
     * @return mixed|string
     */
    private static function getCustomException($exception)
    {
        $exceptions = config('exceptions.list');
        $class = get_class($exception);

        if (array_key_exists($class, $exceptions)) {
            return $exceptions[$class];
        }

        return '';
    }

    private static function prepareCode(Throwable $exception)
    {
        $code = $exception->getCode();
        if ($code === 0) {
            return Response::HTTP_NOT_ACCEPTABLE;
        }

        return $code;
    }

    private static function prepareMessage(Throwable $exception)
    {
        $message = $exception->getMessage();
        if (!empty($message)) {
            return $message;
        }

        return 'Whoops! something went wrong... :(';
    }
}
