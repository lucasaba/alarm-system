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
     * Can be called only if a related zone has triggered an event
     *
     * @param Zone $zone
     * @return array
     * @throws \Exception
     */
    public function getEventsByZone(Zone $zone) {
        $eventList = array();
        $triggeringZone = ZoneSession::getInstance()->getTriggeringZone();
        $isRelated = false;
        if ($triggeringZone != null) {
            foreach ($zone->getRelatedZones() as $relatedZone) {
                if ($relatedZone == $triggeringZone) {
                    $isRelated = true;
                    break;
                }
            }
            if ($isRelated) {
                $eventList = EventDAO::findEventsByZone($zone);
            }
            return $eventList;
        } else {
            throw new NoTriggeringZoneException();
        }
    }
}