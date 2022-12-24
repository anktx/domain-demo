<?php

declare(strict_types=1);

namespace tests\unit\Car;

use mss\Core\Domain\Car\Sensor\AlarmSensor;
use mss\Core\Domain\Car\Sensor\FuelSensor;
use mss\Core\Domain\Car\Sensor\SensorType;
use mss\Core\Domain\Car\SensorList;
use PHPUnit\Framework\TestCase;

class SensorListTest extends TestCase
{
    public function testJson()
    {
        $list = new SensorList();
        $list->add(new AlarmSensor(SensorType::alarm, 1));
        $list->add(new FuelSensor(SensorType::fuel, 1, 82));

        $std = json_decode(json_encode($list));

        $this->assertEquals(82, $std->fuel->idx1->capacity);
    }
}
