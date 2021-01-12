<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Mockery\Exception;
use Illuminate\Http\Response;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Contracts\ApiExceptionAbstract;
use Liateam\ApiExceptions\Exceptions\CustomRouteNotFoundException;

class CustomRouteNotFoundExceptionTest extends BaseTestCase
{
    /**
     * @var CustomRouteNotFoundException
     */
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new CustomRouteNotFoundException(new Exception('route not found' , Response::HTTP_NOT_FOUND));
    }

    /**
     * @covers CustomRouteNotFoundException::setCode()
     * @covers CustomRouteNotFoundException::getCode()
     * @covers CustomRouteNotFoundException::setMessage()
     * @covers CustomRouteNotFoundException::getMessage()
     * @covers CustomRouteNotFoundException::setErrors()
     * @covers CustomRouteNotFoundException::getErrors()
     * @covers CustomRouteNotFoundException::__construct()
     */
    public function test_route_not_found_exception_is_instance_of_ApiException(): void
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomRouteNotFoundException::getCode()
     */
    public function test_can_get_correct_code_from_route_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->instance->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomRouteNotFoundException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomRouteNotFoundException::getMessage()
     */
    public function test_can_correct_message_from_route_not_found_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText , $this->instance->getMessage());
    }
    /**
     * @throws \Throwable
     * * @covers CustomRouteNotFoundException::render();
     */
    public function test_can_render_route_not_found_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            $this->instance
        );

        self::assertInstanceOf($this->expected,$actual);
        self::assertEquals(Response::HTTP_NOT_FOUND, $actual->getCode());
    }
}
