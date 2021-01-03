<?php

namespace Liateam\ApiException\Tests\Unit;

use Liateam\ApiException\Tests\BaseTestCase;
use Liateam\ApiException\Exceptions\CustomDefaultException;

class CustomDefaultExceptionTest extends BaseTestCase
{
    /**
     * @throws \Throwable
     * @covers \Liateam\ApiException\Exceptions\CustomDefaultException::render()
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
