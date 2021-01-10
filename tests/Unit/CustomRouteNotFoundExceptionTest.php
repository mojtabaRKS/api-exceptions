<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiExceptions\Exceptions\CustomRouteNotFoundException;
use Liateam\ApiExceptions\Tests\BaseTestCase;

class CustomRouteNotFoundExceptionTest extends BaseTestCase
{
    /**
     * @throws \Throwable
     * * @covers CustomRouteNotFoundException::render();
     */
    public function test_can_render_route_not_found_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomRouteNotFoundException
        );

        $this->assertInstanceOf($this->expected,$actual);
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $actual->getCode());
    }
}
