<?php

declare(strict_types=1);

namespace tests\unit\ValueObject;

use mss\Core\Shared\ValueObject\PositiveOrNull;
use PHPUnit\Framework\TestCase;

class PositiveOrNullTest extends TestCase
{
    public function testNullValue()
    {
        $this->assertEquals(null, PositiveOrNull::create(null)->value());
    }
}
