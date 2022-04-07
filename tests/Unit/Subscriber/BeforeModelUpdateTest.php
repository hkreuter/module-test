<?php

/**
 * Copyright © Fake IT. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace HkReuter\ModuleTest\Tests\Unit\Subscriber;

use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use OxidEsales\EshopCommunity\Internal\Transition\ShopEvents\BeforeModelUpdateEvent;
use HkReuter\ModuleTest\Model\GreetingTracker;
use HkReuter\ModuleTest\Service\Tracker;
use HkReuter\ModuleTest\Subscriber\BeforeModelUpdate;
use OxidEsales\TestingLibrary\UnitTestCase;

final class BeforeModelUpdateTest extends UnitTestCase
{
    public const TEST_USER_ID = '_testuser';

    public function testHandleEventWithNotMatchingPayload(): void
    {
        $event = new BeforeModelUpdateEvent(oxNew(GreetingTracker::class));

        $handler = $this->getMockBuilder(BeforeModelUpdate::class)
            ->onlyMethods(['getServiceFromContainer'])
            ->getMock();
        $handler->expects($this->never())
            ->method('getServiceFromContainer');

        $handler->handle($event);
    }

    public function testHandleEventWithMatchingPayload(): void
    {
        $event = new BeforeModelUpdateEvent(oxNew(EshopModelUser::class));

        $tracker = $this->getMockBuilder(Tracker::class)
            ->disableOriginalConstructor()
            ->getMock();
        $tracker->expects($this->once())
        ->method('updateTracker');

        $handler = $this->getMockBuilder(BeforeModelUpdate::class)
            ->onlyMethods(['getServiceFromContainer'])
            ->getMock();
        $handler->method('getServiceFromContainer')
            ->with($this->equalTo(Tracker::class))
            ->willReturn($tracker);

        $handler->handle($event);
    }
}
