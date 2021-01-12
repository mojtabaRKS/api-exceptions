<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Mockery\Exception;
use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException;

class CustomUnauthorizedExceptionTest extends BaseTestCase
{
    /**
     * @var CustomUnauthorizedException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomUnauthorizedException(new Exception('Unauthorized', Response::HTTP_UNAUTHORIZED));
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::setCode()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::setErrors()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::getErrors()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::__construct()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::test_unauthorized_exception_is_instance_of_ApiException
     */
    public function test_unauthorized_exception_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(ApiExceptionAbstract::class, $this->instance);
        self::assertTrue(method_exists($this->instance, 'setCode'));
        self::assertTrue(method_exists($this->instance, 'getCode'));
        self::assertTrue(method_exists($this->instance, 'setMessage'));
        self::assertTrue(method_exists($this->instance, 'getMessage'));
        self::assertTrue(method_exists($this->instance, 'setErrors'));
        self::assertTrue(method_exists($this->instance, 'getErrors'));
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::setCode
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::test_can_get_correct_code_from_unauthorized_exception
     */
    public function test_can_get_correct_code_from_unauthorized_exception(): void
    {
        self::assertEquals(Response::HTTP_UNAUTHORIZED, $this->instance->getCode());

        self::assertEquals(404 , $this->instance->setCode(404)->getCode());

        $exception = new CustomUnauthorizedException(new Exception);
        self::assertEquals(0, $exception->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::setMessage()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::test_can_get_correct_message_from_unauthorized_exception
     */
    public function test_can_get_correct_message_from_unauthorized_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText, $this->instance->getMessage());
    }

    /**
     * @throws Throwable
     *
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::render()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomUnauthorizedExceptionTest::test_can_render_unauthorized_exception
     * @uses   \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_can_render_unauthorized_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
        self::assertEquals(Response::HTTP_UNAUTHORIZED, $actual->getCode());
    }
}
