<?php

declare(strict_types=1);

namespace mss\Core\Service\Telemetry;

use mss\Core\Contract\TelemetryServiceInterface;
use mss\Telemetry\TelemetryRich;

class RedisTelemetryService implements TelemetryServiceInterface
{
    /**
     * @param \Redis $redis
     */
    public function __construct(
        protected readonly mixed $redis,
        protected readonly string $key,
    ) {
    }

    public function telemetry(int $unitId): TelemetryRich
    {
        $str = $this->redis->hGet($this->key, (string) $unitId);

        return $str !== false
            ? TelemetryRich::create($str)
            : TelemetryRich::createEmpty($unitId);
    }
}
