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
     * @param Zone $zone
     * @return array
     * @throws \Exception
     */
    public function getEventsFormRelatedZoneOf(Zone $zone) {
        $eventList = array();
        $lastTriggeringZone = ZoneSession::getInstance()->getLastTriggeringZone();
        $isRelated = false;
        if ($lastTriggeringZone != null) {
            foreach ($zone->getRelatedZones() as $relatedZone) {
                if ($relatedZone == $lastTriggeringZone) {
                    $isRelated = true;
                    break;
                }
            }
            if ($isRelated) {
                $eventList = EventDAO::findEventsByZone($lastTriggeringZone);
            }
            return $eventList;
        } else {
            throw new NoTriggeringZoneException();
        }
    }
}