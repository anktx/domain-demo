<?php

declare(strict_types=1);

namespace mss\Core\Domain\User;

use mss\Core\Domain\Car\Car;
use mss\Core\Domain\User\Event\UserCarAddedEvent;
use mss\Core\Domain\User\Event\UserCarRemovedEvent;
use mss\Core\Domain\User\Event\UserPasswordChangedEvent;
use mss\Core\Domain\User\Event\UserAccessChangedEvent;
use mss\Core\Domain\User\Event\UserZoneAddedEvent;
use mss\Core\Domain\User\Event\UserZoneRemovedEvent;
use mss\Core\Domain\User\Exception\ActionNotAllowedException;
use mss\Core\Domain\User\Exception\UserCarNotFoundException;
use mss\Core\Domain\User\Exception\UserZoneNotFoundException;
use mss\Core\Domain\User\Exception\WrongOldPasswordException;
use mss\Core\Domain\Zone\Zone;
use mss\Core\Shared\Domain\Entity;

class User extends Entity implements \JsonSerializable
{
    public function __construct(
        protected readonly UserId $id,
        protected readonly PayerId $payerId,
        protected readonly Login $login,
        protected Password $password,
        protected Access $access,
        protected CalcParams $calcParams,
        protected readonly CarsList $cars,
        protected readonly ZonesList $zones,
    ) {
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function payerId(): PayerId
    {
        return $this->payerId;
    }

    public function login(): Login
    {
        return $this->login;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function access(): Access
    {
        return $this->access;
    }

    public function calcParams(): CalcParams
    {
        return $this->calcParams;
    }

    public function can(Action $action): bool
    {
        return $this->access->allowed($action);
    }

    public function assertCan(Action $action): void
    {
        if (! $this->can($action)) {
            throw ActionNotAllowedException::action($action);
        }
    }

    public function accessResume(): void
    {
        $this->grant(Action::use_app);
    }

    public function accessSuspend(): void
    {
        $this->revoke(Action::use_app);
    }

    public function grant(Action $action): void
    {
        $this->setAccess($this->access->value() | $action->value);
    }

    public function revoke(Action $action): void
    {
        $this->setAccess($this->access->value() ^ $action->value);
    }

    public function setAccess(int $value): void
    {
        $access = Access::create($value);

        if ($this->access->equals($access)) {
            return;
        }

        $this->access = $access;

        $this->recordEvent(UserAccessChangedEvent::create($this));
    }

    public function changePassword(string $old, string $new): void
    {
        if (! $this->password()->equals(Password::create($old))) {
            throw WrongOldPasswordException::msg('Wrong old password specified');
        }

        $this->setPassword($new);

        $this->recordEvent(UserPasswordChangedEvent::create($this->id()->value(), $new));
    }

    public function setPassword(string $password): void
    {
        $this->password = Password::create($password);
    }

    public function carsQty(): int
    {
        return count($this->cars);
    }

    /**
     * @return array<int,int>
     */
    public function carIds(): array
    {
        return $this->cars->items();
    }

    public function addCar(Car $car, int $position): void
    {
        $this->cars->add($car->id()->value(), $position);

        $this->recordEvent(UserCarAddedEvent::create($this->id()->value(), $car));
    }

    public function hasCar(Car $car): bool
    {
        return $this->cars->contains($car->id()->value());
    }

    public function assertHasCar(Car $car): void
    {
        if (! $this->hasCar($car)) {
            throw UserCarNotFoundException::create($car->id()->value());
        }
    }

    public function removeCar(Car $car): void
    {
        if (! $this->hasCar($car)) {
            return;
        }

        $this->cars->remove($car->id()->value());

        $this->recordEvent(UserCarRemovedEvent::create($this->id()->value(), $car));
    }

    public function zonesQty(): int
    {
        return count($this->zones);
    }

    /**
     * @return array<int,int>
     */
    public function zoneIds(): array
    {
        return $this->zones->items();
    }

    public function addZone(Zone $zone, int $position): void
    {
        $this->zones->add($zone->id()->value(), $position);

        $this->recordEvent(UserZoneAddedEvent::create($this->id()->value(), $zone));
    }

    public function hasZone(Zone $zone): bool
    {
        return $this->zones->contains($zone->id()->value());
    }

    public function assertHasZone(Zone $zone): void
    {
        if (! $this->hasZone($zone)) {
            throw UserZoneNotFoundException::create($zone->id()->value());
        }
    }

    public function removeZone(Zone $zone): void
    {
        if (! $this->hasZone($zone)) {
            return;
        }

        $this->zones->remove($zone->id()->value());

        $this->recordEvent(UserZoneRemovedEvent::create($this->id()->value(), $zone));
    }

    public function jsonSerialize(): array
    {
        return [
            'login' => $this->login()->value(),
            'rights' => $this->access->actionNames(),
        ];
    }
}
