<?php

declare(strict_types=1);

namespace tests\unit\User;

use mss\Core\Domain\User\PayerId;
use PHPUnit\Framework\TestCase;

class PayerIdTest extends TestCase
{
    public function testNullPayerId()
    {
        $this->expectNotToPerformAssertions();

        PayerId::create(null);
    }
}
