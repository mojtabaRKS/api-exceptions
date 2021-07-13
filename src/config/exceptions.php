<?php

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomAuthenticationException;
use \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomModelNotFoundException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomNotFoundHttpException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomUnauthorizedException;
use \Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomDefaultException;
use Mojtabarks\ApiExceptions\Exceptions\CustomMethodNotAllowed;
use Mojtabarks\ApiExceptions\Exceptions\CustomQueryException;
use \Mojtabarks\ApiExceptions\Exceptions\CustomValidationException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return [
    'list' => [
        QueryException::class                   => CustomQueryException::class,
        RuntimeException::class                 => CustomDefaultException::class,
        Exception::class                        => CustomDefaultException::class,
        ValidationException::class              => CustomValidationException::class,
        NotFoundHttpException::class            => CustomNotFoundHttpException::class,
        ModelNotFoundException::class           => CustomModelNotFoundException::class,
        AuthenticationException::class          => CustomAuthenticationException::class,
        UnauthorizedHttpException::class        => CustomUnauthorizedException::class,
        MethodNotAllowedHttpException::class    => CustomMethodNotAllowed::class
    ],
];
