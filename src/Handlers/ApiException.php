<?php

namespace Mojtabarks\ApiExceptions\Handlers;

use Mojtabarks\ApiExceptions\Exceptions\CustomDefaultException;
use Mojtabarks\ApiResponse\Contracts\ResponseContract;
use Throwable;

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
     *
     * @return ResponseContract
     */
    public static function handle(Throwable $exception)
    {
        $customException = static::getCustomException($exception);
        $exceptionObject = (class_exists($customException)) ? new $customException($exception) : new CustomDefaultException($exception);

        return $exceptionObject->render();
    }

    /**
     * returns mapped laravel|lumen class with mapped custom class.
     *
     * @param $exception
     *
     * @return mixed|string
     */
    private static function getCustomException($exception)
    {
        $class = get_class($exception);

        if (array_key_exists($class, config('exceptions.list'))) {
            return config('exceptions.list')[$class];
        }

        return null;
    }
}
