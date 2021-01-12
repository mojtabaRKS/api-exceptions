<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomDefaultException;
use Mockery\Exception;

class CustomDefaultExceptionTest extends BaseTestCase
{
    /**
     * @var CustomDefaultException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomDefaultException(new Exception('default error', Response::HTTP_INTERNAL_SERVER_ERROR));
    }

    /**
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomDefaultException::setCode()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomDefaultException::setMessage()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomDefaultException::setErrors()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomDefaultException::getErrors()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct()
     * @covers  \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct()
     *
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::test_default_exception_is_instance_of_ApiException
     */
    public function test_default_exception_is_instance_of_ApiException(): void
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::setCode()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct()
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::test_can_get_correct_code_from_default_exception
     */
    public function test_can_get_correct_code_from_default_exception(): void
    {
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->instance->getCode());

        self::assertEquals(404 , $this->instance->setCode(404)->getCode());

        $exception = new CustomDefaultException((new Exception));
        self::assertEquals(0, $exception->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::setMessage()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::test_can_get_correct_message_from_default_exception
     */
    public function test_can_get_correct_message_from_default_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText, $this->instance->getMessage());
    }

    /**
     * @throws \Throwable
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::render()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomDefaultExceptionTest::test_can_render_default_exception
     * @uses   \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_can_render_default_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
    }
}
