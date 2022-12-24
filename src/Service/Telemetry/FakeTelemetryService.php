<?php

declare(strict_types=1);

namespace mss\Core\Service\Telemetry;

use mss\Core\Contract\TelemetryServiceInterface;
use mss\Core\Domain\Car\CarEngineState;
use mss\Telemetry\TelemetryRich;

class FakeTelemetryService implements TelemetryServiceInterface
{
    public function __construct(
        protected readonly CarEngineState $engineState,
    ) {
    }

    public function telemetry(int $unitId): TelemetryRich
    {
        return TelemetryRich::createFake($unitId, $this->engineState === CarEngineState::locked);
    }
}
