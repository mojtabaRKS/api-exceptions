<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException;
use Mockery\Exception;

class CustomModelNotFoundExceptionTest extends BaseTestCase
{
    /**
     * @var CustomModelNotFoundException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomModelNotFoundException(new Exception('model not found' , Response::HTTP_NOT_FOUND));
    }

    /**
     * @covers CustomModelNotFoundException::setCode()
     * @covers CustomModelNotFoundException::getCode()
     * @covers CustomModelNotFoundException::setMessage()
     * @covers CustomModelNotFoundException::getMessage()
     * @covers CustomModelNotFoundException::setErrors()
     * @covers CustomModelNotFoundException::getErrors()
     * @covers CustomModelNotFoundException::__construct()
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::getCode()
     */
    public function test_can_get_correct_code_from_model_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->instance->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomModelNotFoundException::getMessage()
     */
    public function test_can_get_correct_message_from_mode_not_found_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }

    /**
     * @throws \Throwable
     * @covers CustomModelNotFoundException::render()
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
