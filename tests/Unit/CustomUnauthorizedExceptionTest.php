<?php

namespace Mojtabarks\ApiExceptions\Tests\Unit;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery\Exception;
use Mojtabarks\ApiExceptions\Exceptions\CustomUnauthorizedException;
use Mojtabarks\ApiExceptions\Tests\BaseTestCase;

class CustomUnauthorizedExceptionTest extends BaseTestCase
{
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomUnauthorizedException(new Exception()))->render();
    }

    public function test_custom_not_found_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }

    public function test_can_get_correct_code_from_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_FORBIDDEN, $this->instance->getData()->code);
    }

    public function test_can_override_code_from_not_found_exception(): void
    {
        $exception = (new CustomUnauthorizedException((new Exception('', Response::HTTP_INTERNAL_SERVER_ERROR))))->render();
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getData()->code);
    }

    public function test_can_get_correct_message_from_not_found_exception(): void
    {
        self::assertEquals('Unauthorized', $this->instance->getData()->message);
    }

    public function test_can_override_message_from_not_found_exception()
    {
        $fakeText = $this->faker->sentence;
        $exception = (new CustomUnauthorizedException((new Exception($fakeText))))->render();
        self::assertEquals($fakeText, $exception->getData()->message);
    }
}
