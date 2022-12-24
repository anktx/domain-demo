<?php

declare(strict_types=1);

namespace tests\repo;

use mss\Core\Source\Json\Builder\JsonCarBuilder;
use mss\Core\Source\Json\Exporter\JsonCarExporter;
use PHPUnit\Framework\TestCase;

class JsonCarBuilderTest extends TestCase
{
    public function testCarBuild()
    {
        $json = '{"carId":449369,"unitId":614994,"serverIp":"111.111.210.203","sensors":[{"type":"lock","index":1,"options":{"pin":"0000"}}],"name":"LADA-\u0420\u0435\u043b\u0435","group":"","icon":{"name":"mdi-car","scale":1}}';

        $car = JsonCarBuilder::load($json)->build();

        $this->assertEquals($json, JsonCarExporter::load($car)->export());
    }
}
