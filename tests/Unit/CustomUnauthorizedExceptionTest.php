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
        $this->instance = new CustomUnauthorizedException(new Exception('Unauthorized' , Response::HTTP_UNAUTHORIZED));
    }

    /**
     * @covers CustomUnauthorizedException::setCode()
     * @covers CustomUnauthorizedException::getCode()
     * @covers CustomUnauthorizedException::setMessage()
     * @covers CustomUnauthorizedException::getMessage()
     * @covers CustomUnauthorizedException::setErrors()
     * @covers CustomUnauthorizedException::getErrors()
     * @covers CustomUnauthorizedException::__construct()
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::getCode()
     */
    public function test_can_get_correct_code_from_unauthorized_exception(): void
    {
        self::assertEquals(Response::HTTP_UNAUTHORIZED, $this->instance->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnauthorizedException::getMessage()
     */
    public function test_can_get_correct_message_from_unauthorized_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }

    /**
     * @throws Throwable
     * @covers CustomUnauthorizedException::render()
     */
    public function test_can_render_unauthorized_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
        self::assertEquals(Response::HTTP_UNAUTHORIZED , $actual->getCode());
    }
}
