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
        $this->instance = new CustomDefaultException(new Exception('default error' , Response::HTTP_INTERNAL_SERVER_ERROR));
    }

    /**
     * @covers CustomDefaultException::setCode()
     * @covers CustomDefaultException::getCode()
     * @covers CustomDefaultException::setMessage()
     * @covers CustomDefaultException::getMessage()
     * @covers CustomDefaultException::setErrors()
     * @covers CustomDefaultException::getErrors()
     * @covers CustomDefaultException::__construct()
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
     * @covers CustomDefaultException::getCode()
     */
    public function test_can_get_correct_code_from_default_exception(): void
    {
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->instance->getCode());
    }

    /**
     * @covers CustomDefaultException::setMessage()
     * @covers CustomDefaultException::getMessage()
     */
    public function test_can_get_correct_message_from_default_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }

    /**
     * @throws \Throwable
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::render()
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
