<?php

/**
 * Copyright © Fake IT. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace HkReuter\ModuleTest\Tests\Codeception\Helper;

use OxidEsales\Codeception\Module\Translation\Translator;
use HkReuter\ModuleTest\Tests\Codeception\AcceptanceTester;

/**
 * @group example
 */
final class ExampleCest
{
    public function testCanOpenShopStartPage(AcceptanceTester $I): void
    {
        $I->wantToTest('that codeception tests are working');

        $I->openShop();
        $I->waitForPageLoad();

        $I->see(Translator::translate('HOME'));
    }
}
