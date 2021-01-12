<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException;
use Mockery\Exception;
use Throwable;

class CustomModelNotFoundExceptionTest extends BaseTestCase
{
    /**
     * @var CustomModelNotFoundException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomModelNotFoundException(new Exception('model not found', Response::HTTP_NOT_FOUND));
    }

    /**
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::setCode()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::setMessage()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::setErrors()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::getErrors()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::__construct()
     * @covers  \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     *
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::test_model_not_found_exception_is_instance_of_ApiException
     */
    public function test_model_not_found_exception_is_instance_of_ApiException(): void
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
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::__construct()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::setCode()
     * @covers  \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     *
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::test_can_get_correct_code_from_model_not_found_exception
     */
    public function test_can_get_correct_code_from_model_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->instance->getCode());

        self::assertEquals(404 , $this->instance->setCode(404)->getCode());

        $exception = new CustomModelNotFoundException((new Exception));
        self::assertEquals(0, $exception->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::setMessage()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::test_can_get_correct_message_from_mode_not_found_exception
     */
    public function test_can_get_correct_message_from_mode_not_found_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText, $this->instance->getMessage());
    }

    /**
     * @throws Throwable
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::render()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomModelNotFoundExceptionTest::test_can_render_model_not_found_exception
     * @uses   \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_can_render_model_not_found_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
        self::assertEquals(Response::HTTP_NOT_FOUND, $actual->getCode());
    }
}
