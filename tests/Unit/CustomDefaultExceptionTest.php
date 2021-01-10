<?php

namespace Liateam\ApiExceptions\Tests\Unit;

use Liateam\ApiExceptions\Tests\BaseTestCase;
use Liateam\ApiExceptions\Exceptions\CustomDefaultException;

class CustomDefaultExceptionTest extends BaseTestCase
{
    /**
     * @throws \Throwable
     * @covers \Liateam\ApiExceptions\Exceptions\CustomDefaultException::render()
     */
    public function test_can_render_default_exception(): void
    {
        $actual = $this->handler->render(
            $this->request,
            new CustomDefaultException
        );

        $this->assertInstanceOf($this->expected, $actual);
    }
}
