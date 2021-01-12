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
        $this->instance = new CustomAuthenticationException(new Exception('unAuthenticated' , Response::HTTP_FORBIDDEN));
    }

    /**
     * @covers CustomAuthenticationException::setCode()
     * @covers CustomAuthenticationException::getCode()
     * @covers CustomAuthenticationException::setMessage()
     * @covers CustomAuthenticationException::getMessage()
     * @covers CustomAuthenticationException::setErrors()
     * @covers CustomAuthenticationException::getErrors()
     * @covers CustomAuthenticationException::__construct()
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
     * @covers CustomAuthenticationException::getCode()
     */
    public function test_can_get_correct_code_from_authentication_exception(): void
    {
        self::assertEquals(Response::HTTP_FORBIDDEN, $this->instance->getCode());
    }

    /**
     * @covers CustomAuthenticationException::setMessage()
     * @covers CustomAuthenticationException::getMessage()
     */
    public function test_can_get_correct_message_from_authentication_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }

    /**
     * @throws Throwable
     * @covers CustomAuthenticationException::render();
     */
    public function test_can_render_authentication_exception() : void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
        self::assertEquals(Response::HTTP_FORBIDDEN, $actual->getCode());
    }
}
