<?php

use \Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Liateam\ApiException\Exceptions\CustomDefaultException;
use \Liateam\ApiException\Exceptions\CustomValidationException;
use \Liateam\ApiException\Exceptions\CustomNotFoundHttpException;
use \Liateam\ApiException\Exceptions\CustomUnauthorizedException;
use \Liateam\ApiException\Exceptions\CustomModelNotFoundException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Liateam\ApiException\Exceptions\CustomAuthenticationException;
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
