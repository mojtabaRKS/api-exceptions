<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiException\Exceptions\CustomRouteNotFoundException;
use Liateam\ApiException\Tests\BaseTestCase;

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
