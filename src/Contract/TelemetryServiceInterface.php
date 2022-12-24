<?php

declare(strict_types=1);

namespace mss\Core\Contract;

use mss\Telemetry\TelemetryRich;

interface TelemetryServiceInterface
{
    public function telemetry(int $unitId): TelemetryRich;
}
