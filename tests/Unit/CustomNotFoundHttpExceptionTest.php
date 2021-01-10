<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Throwable;
use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Exceptions\CustomNotFoundHttpException;

class CustomNotFoundHttpExceptionTest extends BaseTestCase
{
    /**
     * @throws Throwable
     * @covers CustomNotFoundHttpException::render()
     */
    public function test_can_render_http_not_found_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomNotFoundHttpException
        );

        $this->assertInstanceOf($this->expected, $actual);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $actual->getCode());
    }
}
