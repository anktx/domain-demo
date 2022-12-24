<?php

declare(strict_types=1);

namespace tests\repo;

use mss\Core\Source\Json\Builder\JsonUserBuilder;
use mss\Core\Source\Json\Exporter\JsonUserExporter;
use PHPUnit\Framework\TestCase;

class JsonUserBuilderTest extends TestCase
{
    public function testUserBuild()
    {
        $json = '{"userId":4593,"payerId":1111,"login":"demotest","password":"demotest","rights":82685,"calcParams":{"speedLimit":90},"carIds":[],"zoneIds":[]}';

        $user = JsonUserBuilder::load($json)->build();

        $this->assertEquals($json, JsonUserExporter::load($user)->export());
    }
}
