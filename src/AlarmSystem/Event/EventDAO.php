<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 06/04/19
 * Time: 13.45
 */

namespace App\AlarmSystem\Event;


use App\AlarmSystem\Exception\DependentClassCalledDuringUnitTestException;
use App\AlarmSystem\Zone\Zone;

class EventDAO
{
    public static function findEventsByZone(Zone $zone)
    {
        throw new DependentClassCalledDuringUnitTestException(
            'TripDAO should not be invoked on an unit test.'
        );

        return null;
    }
}