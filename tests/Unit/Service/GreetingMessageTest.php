<?php

/**
 * Copyright © Fake IT. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace HkReuter\ModuleTest\Tests\Unit\Service;

use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use OxidEsales\Eshop\Core\Request as CoreRequest;
use HkReuter\ModuleTest\Core\Module as ModuleCore;
use HkReuter\ModuleTest\Service\GreetingMessage;
use HkReuter\ModuleTest\Service\ModuleSettings;
use OxidEsales\TestingLibrary\UnitTestCase;

final class GreetingMessageTest extends UnitTestCase
{
    public function testGenericGreetingNoUser(): void
    {
        $service = new GreetingMessage(
            $this->getSettingsMock(ModuleSettings::GREETING_MODE_GENERIC),
            oxNew(CoreRequest::class)
        );

        $this->assertSame(ModuleCore::DEFAULT_PERSONAL_GREETING_LANGUAGE_CONST, $service->getOetmGreeting());
    }

    public function testPersonalGreetingNoUser(): void
    {
        $service = new GreetingMessage(
            $this->getSettingsMock(),
            oxNew(CoreRequest::class)
        );

        $this->assertSame('', $service->getOetmGreeting());
    }

    public function testModuleGenericGreetingModeEmptyUser(): void
    {
        $service = new GreetingMessage(
            $this->getSettingsMock(ModuleSettings::GREETING_MODE_GENERIC),
            oxNew(CoreRequest::class)
        );
        $user    = oxNew(EshopModelUser::class);

        $this->assertSame(ModuleCore::DEFAULT_PERSONAL_GREETING_LANGUAGE_CONST, $service->getOetmGreeting($user));
    }

    public function testModulePersonalGreetingModeEmptyUser(): void
    {
        $service = new GreetingMessage(
            $this->getSettingsMock(),
            oxNew(CoreRequest::class)
        );
        $user    = oxNew(EshopModelUser::class);

        $this->assertSame('', $service->getOetmGreeting($user));
    }

    public function testModuleGenericGreeting(): void
    {
        $service = new GreetingMessage(
            $this->getSettingsMock(ModuleSettings::GREETING_MODE_GENERIC),
            oxNew(CoreRequest::class)
        );
        $user    = oxNew(EshopModelUser::class);
        $user->setPersonalGreeting('Hi sweetie!');

        $this->assertSame(ModuleCore::DEFAULT_PERSONAL_GREETING_LANGUAGE_CONST, $service->getOetmGreeting($user));
    }

    public function testModulePersonalGreeting(): void
    {
        $service = new GreetingMessage(
            $this->getSettingsMock(),
            oxNew(CoreRequest::class)
        );
        $user    = oxNew(EshopModelUser::class);
        $user->setPersonalGreeting('Hi sweetie!');

        $this->assertSame('Hi sweetie!', $service->getOetmGreeting($user));
    }

    private function getSettingsMock(string $mode = ModuleSettings::GREETING_MODE_PERSONAL): ModuleSettings
    {
        $settings = $this->getMockBuilder(ModuleSettings::class)
            ->disableOriginalConstructor()
            ->getMock();
        $settings->expects($this->any())
            ->method('getGreetingMode')->willReturn($mode);

        return $settings;
    }
}
