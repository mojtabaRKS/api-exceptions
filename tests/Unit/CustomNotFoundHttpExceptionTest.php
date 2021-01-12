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
        $this->instance = new CustomNotFoundHttpException(new Exception('HTTP not found', Response::HTTP_NOT_FOUND));
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::setCode()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::setMessage()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::setErrors()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::getErrors()
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::__construct()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::test_not_found_http_exception_is_instance_of_ApiException
     */
    public function test_not_found_http_exception_is_instance_of_ApiException(): void
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
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::setCode
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::test_can_get_correct_code_from_http_not_found_exception
     */
    public function test_can_get_correct_code_from_http_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->instance->getCode());

        self::assertEquals(404 , $this->instance->setCode(404)->getCode());

        $exception = new CustomNotFoundHttpException((new Exception));
        self::assertEquals(0, $exception->getCode());
    }

    /**
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::setMessage()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::__construct
     *
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::test_can_get_correct_message_from_http_not_found_exception
     */
    public function test_can_get_correct_message_from_http_not_found_exception(): void
    {
        $fakeText = $this->faker->sentence;
        $this->instance->setMessage($fakeText);
        self::assertEquals($fakeText, $this->instance->getMessage());
    }

    /**
     * @throws Throwable
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::render()
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::__construct
     * @covers \Liateam\ApiExceptions\Contracts\ApiExceptionAbstract::getErrors
     * @covers \Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException::__construct
     *
     * @uses   \Liateam\ApiResponse\Responses\FailureResponse::__construct
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::getCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setCode
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setMessage
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseKey
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setResponseValue
     * @uses   \Liateam\ApiResponse\Traits\HasProperty::setSuccessStatus
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::createApplication
     * @uses   \Liateam\ApiExceptions\Tests\BaseTestCase::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::setUp
     * @uses   \Liateam\ApiExceptions\Tests\Unit\CustomNotFoundHttpExceptionTest::test_can_render_http_not_found_exception
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
