<?php

namespace Mojtabarks\ApiExceptions\Tests\Unit;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery\Exception;
use Mojtabarks\ApiExceptions\Exceptions\CustomUnexpectedException;
use Mojtabarks\ApiExceptions\Tests\BaseTestCase;

class CustomUnexpectedExceptionTest extends BaseTestCase
{
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomUnexpectedException(new Exception()))->render();
    }

    public function test_custom_not_found_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }

    public function test_can_get_correct_code_from_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->instance->getData()->code);
    }

    public function test_can_override_code_from_not_found_exception(): void
    {
        $exception = (new CustomUnexpectedException((new Exception('', Response::HTTP_FORBIDDEN))))->render();
        self::assertEquals(Response::HTTP_FORBIDDEN, $exception->getData()->code);
    }

    public function test_can_get_correct_message_from_not_found_exception(): void
    {
        self::assertEquals('Unexpected Exception', $this->instance->getData()->message);
    }

    public function test_can_override_message_from_not_found_exception()
    {
        $fakeText = $this->faker->sentence;
        $exception = (new CustomUnexpectedException((new Exception($fakeText))))->render();
        self::assertEquals($fakeText, $exception->getData()->message);
    }
}
