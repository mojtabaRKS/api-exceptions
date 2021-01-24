<?php

/**
 * @codeCoverageIgnore
 */

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Mojtabarks\ApiExceptions\Exceptions\CustomAuthenticationException;
use Mojtabarks\ApiExceptions\Exceptions\CustomDefaultException;
use Mojtabarks\ApiExceptions\Exceptions\CustomModelNotFoundException;
use Mojtabarks\ApiExceptions\Exceptions\CustomNotFoundHttpException;
use Mojtabarks\ApiExceptions\Exceptions\CustomUnauthorizedException;
use Mojtabarks\ApiExceptions\Exceptions\CustomValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
