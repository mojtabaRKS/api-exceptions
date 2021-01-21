<?php

/**
 * @codeCoverageIgnore
 */

use \Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomDefaultException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomValidationException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomNotFoundHttpException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomUnauthorizedException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomModelNotFoundException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomAuthenticationException;
use \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return [
    'list' => [
        RuntimeException::class             => CustomDefaultException::class,
        Exception::class                    => CustomDefaultException::class,
        ValidationException::class          => CustomValidationException::class,
        NotFoundHttpException::class        => CustomNotFoundHttpException::class,
        ModelNotFoundException::class       => CustomModelNotFoundException::class,
        AuthenticationException::class      => CustomAuthenticationException::class,
        UnauthorizedHttpException::class    => CustomUnauthorizedException::class,
    ],
];
