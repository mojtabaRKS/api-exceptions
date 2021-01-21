<?php

namespace Mojtabarks\ApiExceptions\Tests\Unit;

use Mockery\Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Mojtabarks\ApiExceptions\Tests\BaseTestCase;
use Mojtabarks\ApiExceptions\Exceptions\CustomDefaultException;

class CustomDefaultExceptionTest extends BaseTestCase
{
  
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomDefaultException(new Exception))->render();
    }

    
    public function test_custom_Default_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }
    

    public function test_can_get_correct_code_from_Default_exception(): void
    {
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->instance->getData()->code);
    }


    public function test_can_override_code_from_Default_exception(): void
    {
        $exception = (new CustomDefaultException((new Exception('',Response::HTTP_NOT_FOUND))))->render();
        self::assertEquals(Response::HTTP_NOT_FOUND, $exception->getData()->code);
    }

    public function test_can_get_correct_message_from_Default_exception(): void
    {
        self::assertEquals('Whoops! something went wrong!' , $this->instance->getData()->message);
    }
    
    public function test_can_override_message_from_Default_exception()
    {
        $fakeText = $this->faker->sentence;
        $exception = (new CustomDefaultException((new Exception($fakeText))))->render();
        self::assertEquals($fakeText, $exception->getData()->message);
    }
}
