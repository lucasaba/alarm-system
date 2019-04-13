<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 06/04/19
 * Time: 13.52
 */

namespace App\Test\AlarmSystem\Event;

use App\AlarmSystem\Event\Event;
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
        $service = new TestableEventService();
        $this->expectException(NoTriggeringZoneException::class);
        $service->getEventsFormRelatedZoneOf(new Zone('Bagno'));
    }

    /**
     * @test
     */
    public function should_return_empty_array_if_triggering_zone_is_not_related()
    {
        $service = new TestableEventService();
        $service->pretendLastTriggeringZoneIs(new Zone('Cucina'));
        $this->assertCount(0, $service->getEventsFormRelatedZoneOf(new Zone('Bagno')));
    }

    /**
     * @test
     */
    public function should_return_empty_array_if_triggering_zone_is_not_related_but_there_are_realted_zone_with_events()
    {
        $service = new TestableEventService();
        $service->pretendLastTriggeringZoneIs(new Zone('Cucina'));
        $bagno = new Zone('Bagno');
        $relatedZone = new Zone('Corridoio');
        $relatedZone->addEvent(new Event());
        $bagno->addRelatedZone($relatedZone);
        $this->assertCount(0, $service->getEventsFormRelatedZoneOf($bagno));
    }

    /**
     * @test
     */
    public function should_return_last_triggering_zone_events_if_zone_is_related()
    {
        $service = new TestableEventService();

        $cuina = new Zone('Cucina');
        $cuina->addEvent(new Event());

        $balcone = new Zone('Balcone');
        $balcone->addEvent(new Event());
        $balcone->addEvent(new Event());
        $service->pretendLastTriggeringZoneIs($balcone);

        $camera = new Zone('Camera');
        $camera->addRelatedZone($balcone);

        $prova =  $service->getEventsFormRelatedZoneOf($camera);
        $this->assertCount(2, $prova);
    }
}

class TestableEventService extends EventService
{
    private $lastTriggeringZone = null;

    public function pretendLastTriggeringZoneIs(Zone $zone)
    {
        $this->lastTriggeringZone = $zone;
    }

    public function getEventsByZone($lastTriggeringZone)
    {
        return $lastTriggeringZone->getEvents();
    }

    protected function getLastTriggeringZone()
    {
        return $this->lastTriggeringZone;
    }
}
