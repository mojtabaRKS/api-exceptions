<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Illuminate\Http\Response;
use Liateam\ApiException\Exceptions\CustomAuthenticationException;
use Liateam\ApiException\Tests\BaseTestCase;

class CustomAuthenticationExceptionTest extends BaseTestCase
{
    /**
     * @throws \Throwable
     * @covers CustomAuthenticationException::render();
     */
    public function test_can_render_authentication_exception() : void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomAuthenticationException
        );

        $this->assertInstanceOf($this->expected, $actual);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $actual->getCode());
    }
}
