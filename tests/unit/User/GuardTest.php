<?php

declare(strict_types=1);

namespace tests\unit\User;

use mss\Core\Domain\User\Access;
use mss\Core\Domain\User\Action;
use PHPUnit\Framework\TestCase;

class GuardTest extends TestCase
{
    public function testGrantAction(): void
    {
        $action = Action::view_x5_fake_temp;

        $guard = Access::create(17149);
        $this->assertFalse($guard->allowed($action));

        $guardNew = Access::create($guard->value() | $action->value);
        $this->assertTrue($guardNew->allowed($action));
    }

    public function testRevokeAction(): void
    {
        $action = Action::use_app;

        $guard = Access::create(17149);
        $this->assertTrue($guard->allowed($action));

        $guardNew = Access::create($guard->value() ^ $action->value);
        $this->assertFalse($guardNew->allowed($action));
    }

    public function testRights()
    {
        $guard = Access::create(17149);

        $this->assertTrue($guard->allowed(Action::use_app));
        $this->assertTrue($guard->allowed(Action::load_track));
        $this->assertTrue($guard->allowed(Action::view_track));
        $this->assertFalse($guard->allowed(Action::login_site));
        $this->assertFalse($guard->allowed(Action::edit_x5_fake_temp));
    }

    public function testArray()
    {
        $guard = Access::create(17149);

        $this->assertIsArray($guard->actionEnums());
        $this->assertTrue(in_array(Action::view_assets, $guard->actionEnums()));
    }

    public function testList()
    {
        $guard = Access::create(17149);

        $this->assertIsArray($guard->actionNames());
        $this->assertTrue(in_array(Action::view_assets->name, $guard->actionNames()));
    }
}
