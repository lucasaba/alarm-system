<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 06/04/19
 * Time: 13.46
 */

namespace App\AlarmSystem\Event;


use App\AlarmSystem\Exception\NoTriggeringZoneException;
use App\AlarmSystem\Zone\Zone;
use App\AlarmSystem\Zone\ZoneSession;

class EventService
{
    /**
     * Il servizio prende come argomento la zona in cui si è scatenato l'ultimo evento.
     *
     * @param Zone $zone
     * @return array
     * @throws \Exception
     */
    public function getEventsFormRelatedZoneOf(Zone $zone) {
        $lastTriggeringZone = $this->getLastTriggeringZone();
        if ($lastTriggeringZone == null) {
            throw new NoTriggeringZoneException();
        }

        return ($zone->isRelatedTo($lastTriggeringZone))
            ? $this->getEventsByZone($lastTriggeringZone)
            : array();
    }

    protected function getLastTriggeringZone()
    {
        return ZoneSession::getInstance()->getLastTriggeringZone();
    }

    protected function getEventsByZone($lastTriggeringZone)
    {
        return EventDAO::findEventsByZone($lastTriggeringZone);
    }
}