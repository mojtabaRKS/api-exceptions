<?php

use \Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Liateam\ApiExceptions\Exceptions\CustomDefaultException;
use \Liateam\ApiExceptions\Exceptions\CustomValidationException;
use \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException;
use \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException;
use \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException;
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
