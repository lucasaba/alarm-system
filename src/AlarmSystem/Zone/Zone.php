<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 06/04/19
 * Time: 13.39
 */

namespace App\AlarmSystem\Zone;


use App\AlarmSystem\Event\Event;

class Zone
{
    private $events;
    private $related_zones;
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->events = array();
        $this->related_zones = array();
    }
    public function getEvents()
    {
        return $this->events;
    }
    public function getRelatedZones()
    {
        return $this->related_zones;
    }
    public function addRelatedZone(Zone $zone)
    {
        $this->related_zones[] = $zone;
    }
    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }
}