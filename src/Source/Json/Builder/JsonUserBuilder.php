<?php

declare(strict_types=1);

namespace mss\Core\Source\Json\Builder;

use mss\Core\Domain\User\Access;
use mss\Core\Domain\User\CalcParams;
use mss\Core\Domain\User\CarsList;
use mss\Core\Domain\User\Login;
use mss\Core\Domain\User\Password;
use mss\Core\Domain\User\PayerId;
use mss\Core\Domain\User\User;
use mss\Core\Domain\User\UserId;
use mss\Core\Domain\User\ZonesList;

class JsonUserBuilder extends AbstractJsonBuilder
{
    public function build(): User
    {
        return new User(
            UserId::create($this->obj->userId),
            PayerId::create($this->obj->payerId),
            Login::create($this->obj->login),
            Password::create($this->obj->password),
            Access::create($this->obj->rights),
            CalcParams::create((array) $this->obj->calcParams),
            CarsList::create((array) $this->obj->carIds),
            ZonesList::create((array) $this->obj->zoneIds),
        );
    }
}
