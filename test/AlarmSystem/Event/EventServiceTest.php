<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 06/04/19
 * Time: 13.52
 */

namespace App\Test\AlarmSystem\Event;

use App\AlarmSystem\Event\EventService;
use App\AlarmSystem\Exception\NoTriggeringZoneException;
use App\AlarmSystem\Zone\Zone;
use PHPUnit\Framework\TestCase;

class EventServiceTest extends TestCase
{
    /**
     * @test
     */
    public function should_throw_an_exception_if_no_last_triggering_zone_is_in_session()
    {
        $service = new class extends EventService {
            protected function getLastTriggeringZone()
            {
                return null;
            }

        };
        $this->expectException(NoTriggeringZoneException::class);
        $service->getEventsFormRelatedZoneOf(new Zone('Bagno'));
    }

    /**
     * @test
     */
    public function should_return_empty_array_if_triggering_zone_is_not_related()
    {
        $service = new class extends EventService {
            protected function getLastTriggeringZone()
            {
                return new Zone('Cucina');
            }

        };
        $this->assertCount(0, $service->getEventsFormRelatedZoneOf(new Zone('Bagno')));
    }
}
