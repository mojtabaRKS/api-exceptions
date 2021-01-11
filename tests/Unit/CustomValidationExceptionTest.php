<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Mockery\Exception;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomValidationException;

class CustomValidationExceptionTest extends BaseTestCase
{
    /**
     * @var CustomValidationException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomValidationException(
            new Exception('validation exception' , Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * @covers CustomValidationException::setCode()
     * @covers CustomValidationException::getCode()
     * @covers CustomValidationException::setMessage()
     * @covers CustomValidationException::getMessage()
     * @covers CustomValidationException::setErrors()
     * @covers CustomValidationException::getErrors()
     * @covers CustomValidationException::__construct()
     */
    public function test_validation_exception_is_instance_of_ApiException(): void
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomValidationException::getCode()
     */
    public function test_can_get_correct_code_from_validation_exception(): void
    {
        self::assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $this->instance->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomValidationException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomValidationException::getMessage()
     */
    public function test_can_get_correct_message_from_validation_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }

    /**
     * @covers CustomValidationException::setErrors()
     * @covers CustomValidationException::getErrors()
     */
    public function text_can_get_correct_errors_from_validation_exception(): void
    {
        $errors = [
            'username' => [
                'username is required',
                'username is not valid'
            ]
        ];
        $this->instance->setErrors($errors);
        self::assertEquals($errors, $this->instance->getErrors());
    }

    /**
     * @throws \Throwable
     * @covers CustomValidationException::render()
     */
    public function test_can_render_validation_exception_response(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected , $actual);
        self::assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $actual->getCode());
    }
}
