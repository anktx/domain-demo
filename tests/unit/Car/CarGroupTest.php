<?php

declare(strict_types=1);

namespace tests\unit\Car;

use mss\Core\Domain\Car\CarGroup;
use PHPUnit\Framework\TestCase;

class CarGroupTest extends TestCase
{
    public function testEmptyGroupName()
    {
        $this->assertTrue(CarGroup::create('')->isEmpty());
    }
}
