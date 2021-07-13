<?php

namespace Mojtabarks\ApiExceptions\Handlers;

use Mojtabarks\ApiExceptions\Exceptions\CustomDefaultException;

class ApiException
{
    /**
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
