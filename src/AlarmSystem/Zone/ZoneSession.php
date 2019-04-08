<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 06/04/19
 * Time: 13.39
 */

namespace App\AlarmSystem\Zone;


use App\AlarmSystem\Exception\DependentClassCalledDuringUnitTestException;

class ZoneSession
{
    /**
     * @var ZoneSession
     */
    private static $zoneSession;

    /**
     * @return ZoneSession
     */
    public static function getInstance()
    {
        if (null === static::$zoneSession) {
            static::$zoneSession = new ZoneSession();
        }
        return static::$zoneSession;
    }

    public function getLastTriggeringZone()
    {
        throw new DependentClassCalledDuringUnitTestException(
            'ZoneSession.getTriggeringZone() should not be called in an unit test'
        );

        return null;
    }
}