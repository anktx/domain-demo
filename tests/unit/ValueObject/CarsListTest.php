<?php

declare(strict_types=1);

namespace tests\unit\ValueObject;

use mss\Core\Domain\User\CarsList;
use PHPUnit\Framework\TestCase;

class CarsListTest extends TestCase
{
    public function testRemove()
    {
        $list = CarsList::create([
            1 => 449368,
            2 => 449365,
            3 => 452958,
            4 => 449369,
            5 => 455543,
            6 => 452959,
            7 => 440043,
        ]);

        $carIdToRemove = 449369;
        $list->remove($carIdToRemove);

        $this->assertNotContains($carIdToRemove, $list->items());
    }
}
