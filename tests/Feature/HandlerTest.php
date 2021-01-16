<?php

namespace Liateam\ApiExceptions\Tests\Feature;

use Mockery\Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Handlers\ApiException;
use Liateam\ApiExceptions\Exceptions\CustomUnexpectedException;
use Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException;
use Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException;
use Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException;
use Liateam\ApiExceptions\Exceptions\CustomRouteNotFoundException;
use Liateam\ApiExceptions\Exceptions\CustomAuthenticationException;

class HandlerTest extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    
    public function test_it_can_handle_unauthenticated_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_FORBIDDEN;

        $response = ApiException::handle(
            new CustomAuthenticationException(
                new Exception($fakeTest, $code)
            )
        );

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

   
    public function test_it_can_handle_default_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;

        $response = ApiException::handle(
            new Exception($fakeTest, $code)
        );

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    
    public function test_it_can_handle_model_not_found_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_NOT_FOUND;

        $response = ApiException::handle(
            new CustomModelNotFoundException(
                new Exception($fakeTest, $code)
            )
        );

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    
    public function test_it_can_handle_not_found_http_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_NOT_FOUND;

        $response = ApiException::handle(
            new CustomNotFoundHttpException(
                new Exception($fakeTest, $code)
            )
        );

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    
    public function test_it_can_handle_route_not_found_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_NOT_FOUND;

        $response = ApiException::handle(
            new CustomRouteNotFoundException(
                new Exception($fakeTest, $code)
            )
        );

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    
    public function test_it_can_handle_unauthorized_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_UNAUTHORIZED;

        $response = ApiException::handle(
            new CustomUnauthorizedException(
                new Exception($fakeTest, $code)
            )
        );

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    
    public function test_it_can_handle_unexpected_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;

        $response = ApiException::handle(
            new CustomUnexpectedException(
                new Exception($fakeTest, $code)
            )
        );

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }
}
