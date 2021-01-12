<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Throwable;
use Mockery\Exception;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomAuthenticationException;

class CustomAuthenticationExceptionTest extends BaseTestCase
{
    /**
     * @var CustomAuthenticationException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomAuthenticationException(new Exception('unAuthenticated', Response::HTTP_FORBIDDEN));
    }

    /**
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::setCode()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::setMessage()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::setErrors()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::getErrors()
     * @covers  \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::__construct()
     * @covers  \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     *
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses    \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::setUp
     * @uses    \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::test_custom_authentication_is_instance_of_ApiException
     */
    public function test_custom_authentication_is_instance_of_ApiException(): void
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::setCode
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::test_can_get_correct_code_from_authentication_exception
     */
    public function test_can_get_correct_code_from_authentication_exception(): void
    {
        self::assertEquals(Response::HTTP_FORBIDDEN, $this->instance->getCode());

        self::assertEquals(404 , $this->instance->setCode(404)->getCode());

        $exception = new CustomAuthenticationException((new Exception));
        self::assertEquals(0, $exception->getCode());

    }

    /**
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::setMessage()
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::test_can_get_correct_message_from_authentication_exception
     */
    public function test_can_get_correct_message_from_authentication_exception(): void
    {
        self::assertEquals('unAuthenticated' , $this->instance->getMessage());

        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText, $this->instance->getMessage());
    }

    /**
     * @throws Throwable
     * @covers \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::render()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Exceptions\CustomAuthenticationException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomAuthenticationExceptionTest::test_can_render_authentication_exception
     * @uses   \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     */
    public function test_can_render_authentication_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
        self::assertEquals(Response::HTTP_FORBIDDEN, $actual->getCode());
    }
}
