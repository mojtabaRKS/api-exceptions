<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Mockery\Exception;
use Throwable;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException;

class CustomNotFoundHttpExceptionTest extends BaseTestCase
{
    /**
     * @var CustomNotFoundHttpException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomNotFoundHttpException(new Exception('HTTP not found' , Response::HTTP_NOT_FOUND));
    }

    /**
     * @covers CustomNotFoundHttpException::setCode()
     * @covers CustomNotFoundHttpException::getCode()
     * @covers CustomNotFoundHttpException::setMessage()
     * @covers CustomNotFoundHttpException::getMessage()
     * @covers CustomNotFoundHttpException::setErrors()
     * @covers CustomNotFoundHttpException::getErrors()
     * @covers CustomNotFoundHttpException::__construct()
     */
    public function test_object_is_instance_of_ApiException(): void
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::getCode()
     */
    public function test_can_get_correct_code_from_http_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->instance->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::getMessage()
     */
    public function test_can_get_correct_message_from_http_not_found_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }

    /**
     * @throws Throwable
     * @covers CustomNotFoundHttpException::render()
     */
    public function test_can_render_http_not_found_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected, $actual);
        self::assertEquals(Response::HTTP_NOT_FOUND, $actual->getCode());
    }
}
