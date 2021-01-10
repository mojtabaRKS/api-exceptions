<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiException\Exceptions\CustomModelNotFoundException;
use Liateam\ApiException\Tests\BaseTestCase;

class CustomModelNotFoundExceptionTest extends BaseTestCase
{
    /**
     * @throws \Throwable
     * @covers CustomModelNotFoundException::render()
     */
    public function test_can_render_model_not_found_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomModelNotFoundException
        );

        $this->assertInstanceOf($this->expected, $actual);
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $actual->getCode());
    }
}
