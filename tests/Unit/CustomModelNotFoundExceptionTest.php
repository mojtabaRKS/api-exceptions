<?php

namespace Mojtabarks\ApiExceptions\Tests\Unit;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery\Exception;
use Mojtabarks\ApiExceptions\Exceptions\CustomModelNotFoundException;
use Mojtabarks\ApiExceptions\Tests\BaseTestCase;

class CustomModelNotFoundExceptionTest extends BaseTestCase
{
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomModelNotFoundException(new Exception()))->render();
    }

    public function test_custom_mode_not_found_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }

    public function test_can_get_correct_code_from_model_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->instance->getData()->code);
    }

    public function test_can_override_code_from_model_not_found_exception(): void
    {
        $exception = (new CustomModelNotFoundException((new Exception('', Response::HTTP_INTERNAL_SERVER_ERROR))))->render();
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getData()->code);
    }

    public function test_can_get_correct_message_from_model_not_found_exception(): void
    {
        self::assertEquals('Model Not Found', $this->instance->getData()->message);
    }
}
