<?php

namespace Liateam\ApiExceptions\Tests;

use ReflectionClass;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Illuminate\Container\Container;
use Laravel\Lumen\Exceptions\Handler;
use Liateam\ApiResponse\Responses\FailureResponse;

class BaseTestCase extends TestCase
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
     * @var string $excepted
     */
    protected $expected;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = $this->createMock(Request::class);
        $this->handler = new Handler($this->createMock(Container::class));
        $this->class = new ReflectionClass(Handler::class);
        $this->method = $this->class->getMethod('render');
        $this->method->setAccessible(true);
        $this->expected = FailureResponse::class;
    }

}
