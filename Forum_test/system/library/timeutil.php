<?php

/**
 * time short summary.
 *
 * time description.
 *
 * @version 1.0
 * @author C
 */
class TimeUtil
{
    static function Initialize($timezone)
    {
        date_default_timezone_set($timezone);
    }
    static function LocalCurrent()
    {
        return  date('Y-m-d H:i:s');
    }
    static function TimeStamp()
    {
        return  date('Y-m-d H:i:s');   
    }
}
