<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiException\Exceptions\CustomUnexpectedException;
use Liateam\ApiException\Tests\BaseTestCase;

class CustomUnexpectedExceptionTest extends BaseTestCase
{
    /**
     * @throws \Throwable
     * @covers CustomUnexpectedException::render
     */
    public function test_can_render_unexpected_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomUnexpectedException
        );

        $this->assertInstanceOf($this->expected, $actual);
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $actual->getCode());
    }
}
