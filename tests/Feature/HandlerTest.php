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

    /**
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::getCustomException()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::render
     * @covers \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::handle
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::test_it_can_handle_unauthenticated_exception
     *
     * @uses \Liateam\ApiResponse\Contracts\ResponseContract::render
     * @uses \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getSuccessStatus
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_it_can_handle_unauthenticated_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_FORBIDDEN;

        $response = ApiException::handle(
            new CustomAuthenticationException(
                new Exception($fakeTest, $code)
            )
        )->render();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::getCustomException()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::render
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::handle
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::test_it_can_handle_default_exception
     *
     * @uses \Liateam\ApiResponse\Contracts\ResponseContract::render
     * @uses \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getSuccessStatus
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_it_can_handle_default_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;

        $response = ApiException::handle(
            new Exception($fakeTest, $code)
        )->render();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::getCustomException()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::render
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::__construct
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::handle
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::test_it_can_handle_model_not_found_exception
     *
     * @uses \Liateam\ApiResponse\Contracts\ResponseContract::render
     * @uses \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getSuccessStatus
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_it_can_handle_model_not_found_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_NOT_FOUND;

        $response = ApiException::handle(
            new CustomModelNotFoundException(
                new Exception($fakeTest, $code)
            )
        )->render();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::getCustomException()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::render
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::__construct
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::handle
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::test_it_can_handle_not_found_http_exception
     *
     * @uses \Liateam\ApiResponse\Contracts\ResponseContract::render
     * @uses \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getSuccessStatus
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_it_can_handle_not_found_http_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_NOT_FOUND;

        $response = ApiException::handle(
            new CustomNotFoundHttpException(
                new Exception($fakeTest, $code)
            )
        )->render();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::getCustomException()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::render
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomRouteNotFoundException::__construct
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::handle
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::test_it_can_handle_route_not_found_exception
     *
     * @uses \Liateam\ApiResponse\Contracts\ResponseContract::render
     * @uses \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getSuccessStatus
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_it_can_handle_route_not_found_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_NOT_FOUND;

        $response = ApiException::handle(
            new CustomRouteNotFoundException(
                new Exception($fakeTest, $code)
            )
        )->render();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::getCustomException()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::render
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::__construct
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::handle
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::test_it_can_handle_unauthorized_exception
     *
     * @uses \Liateam\ApiResponse\Contracts\ResponseContract::render
     * @uses \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getSuccessStatus
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_it_can_handle_unauthorized_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_UNAUTHORIZED;

        $response = ApiException::handle(
            new CustomUnauthorizedException(
                new Exception($fakeTest, $code)
            )
        )->render();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::render
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnexpectedException::__construct
     * @covers \Liateam\ApiExceptions\Handlers\ApiException::handle
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @covers \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::setUp
     * @covers \Liateam\ApiExceptions\Tests\Feature\HandlerTest::test_it_can_handle_unexpected_exception
     *
     * @uses \Liateam\ApiResponse\Contracts\ResponseContract::render
     * @uses \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::getSuccessStatus
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setResult
     * @uses \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     * @uses \Liateam\ApiExceptions\Handlers\ApiException::getCustomException()
     */
    public function test_it_can_handle_unexpected_exception(): void
    {
        $fakeTest = $this->faker->sentence;
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;

        $response = ApiException::handle(
            new CustomUnexpectedException(
                new Exception($fakeTest, $code)
            )
        )->render();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals($fakeTest, $response->getData()->message);
        self::assertEquals($code, $response->getStatusCode());
    }
}
