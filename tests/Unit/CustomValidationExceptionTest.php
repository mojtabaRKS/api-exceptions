<?php

namespace Liateam\ApiException\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiException\Exceptions\CustomValidationException;
use Liateam\ApiException\Tests\BaseTestCase;

class CustomValidationExceptionTest extends BaseTestCase
{
    /**
     * @throws \Throwable
     * @covers CustomValidationException::render()
     */
    public function test_can_render_validation_exception_response(): void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomValidationException
        );

        $this->assertInstanceOf($this->expected , $actual);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $actual->getCode());
    }
}
