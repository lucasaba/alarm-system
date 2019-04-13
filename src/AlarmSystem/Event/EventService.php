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
        $eventList = array();
        $lastTriggeringZone = $this->getLastTriggeringZone();
        if ($lastTriggeringZone != null) {
            $isRelated = $zone->isRelatedTo($lastTriggeringZone);
            if ($isRelated) {
                $eventList = $this->getEventsByZone($lastTriggeringZone);
            }
            return $eventList;
        } else {
            throw new NoTriggeringZoneException();
        }
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