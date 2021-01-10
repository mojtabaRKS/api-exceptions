<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Throwable;
use Liateam\ApiResponse\ApiResponse;
use Liateam\ApiException\Tests\BaseTestCase;
use Liateam\ApiException\Exceptions\CustomUnauthorizedException;

class CustomUnauthorizedExceptionTest extends BaseTestCase
{
    /**
     * @throws Throwable
     * @covers CustomUnauthorizedException::render()
     */
    public function test_can_render_unauthorized_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomUnauthorizedException
        );

        $this->assertInstanceOf($this->expected, $actual);
        $this->assertEquals(Response::HTTP_FORBIDDEN , $actual->getCode());
    }
}
