<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Mockery\Exception;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomUnexpectedException;

class CustomUnexpectedExceptionTest extends BaseTestCase
{
    /**
     * @var CustomUnexpectedException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomUnexpectedException(new Exception('unexpected exception' , Response::HTTP_INTERNAL_SERVER_ERROR));
    }

    /**
     * @covers CustomUnexpectedException::setCode()
     * @covers CustomUnexpectedException::getCode()
     * @covers CustomUnexpectedException::setMessage()
     * @covers CustomUnexpectedException::getMessage()
     * @covers CustomUnexpectedException::setErrors()
     * @covers CustomUnexpectedException::getErrors()
     * @covers CustomUnexpectedException::__construct()
     */
    public function test_unexpected_exception_is_instance_of_ApiException(): void
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnexpectedException::getCode()
     */
    public function test_can_get_correct_code_from_unexpected_exception(): void
    {
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->instance->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnexpectedException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomUnexpectedException::getMessage()
     */
    public function test_can_get_correct_message_from_unexpected_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }

    /**
     * @throws \Throwable
     * @covers CustomUnexpectedException::render
     */
    public function test_can_render_unexpected_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $actual->getCode());
    }
}
