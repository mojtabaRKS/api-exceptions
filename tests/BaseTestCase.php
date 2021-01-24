<?php

namespace Mojtabarks\ApiExceptions\Tests;

use Faker\Factory;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Laravel\Lumen\Exceptions\Handler;
use Laravel\Lumen\Testing\TestCase;
use Mojtabarks\ApiResponse\Responses\FailureResponse;
use ReflectionClass;

abstract class BaseTestCase extends TestCase
{
    /**
     * @var Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $request;

    /**
     * @var Handler
     */
    protected $handler;

    /**
     * @var \ReflectionMethod
     */
    protected $method;

    /**
     * @var ReflectionClass
     */
    protected $class;

    /**
     * @var string
     */
    protected $expected;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = $this->createMock(Request::class);
        $this->handler = new Handler($this->createMock(Container::class));
        $this->class = new ReflectionClass(Handler::class);
        $this->method = $this->class->getMethod('render');
        $this->method->setAccessible(true);
        $this->expected = FailureResponse::class;

        $this->faker = Factory::create();
    }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../../../../bootstrap/app.php';
    }
}
