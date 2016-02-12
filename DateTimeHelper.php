<?php
/**
 * Taktwerk.ch 2016
 * tw-yii2-rest package
 */

namespace taktwerk\rest;

use yii;

class DateTimeHelper
{
    /**
     * @param $rawString
     * @return int
     */
    private static function createTimeStamp($rawString)
    {
        $stringArr = date_parse($rawString);
        $year = $stringArr['year'];
        $month = $stringArr['month'];
        $day = $stringArr['day'];
        $hour = $stringArr['hour'];
        $minute = $stringArr['minute'];
        $second = $stringArr['second'];
        return mktime($hour, $minute, $second, $month, $day, $year);
    }

    /**
     * @param $time
     * @return array|bool
     */
    public static function isNormalTime($time)
    {
        $patterns = [
            'second' => '/^[1-2]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}$/',
            'minute' => '/^[1-2]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}$/',
            'hour' => '/^[1-2]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}\s[0-9]{2}$/',
            'day' => '/^[1-2]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}$/',
            'month' => '/^[1-2]{1}[0-9]{3}-[0-9]{2}$/'
        ];

        foreach ($patterns as $key => $pattern) {
            if (preg_match($pattern, $time, $match)) {
                if ($key == 'hour') {
                    return ['type' => $key, 'value' => $match[0] . ":00"];
                } else {
                    return ['type' => $key, 'value' => $match[0]];
                }
            }
        }
        return false;
    }

    /**
     * @param $time
     * @return array|null
     */
    public static function getMaxNormalTime($time)
    {
        $value = self::createTimeStamp($time['value']);
        switch ($time['type']) {
            case 'second':
                return ['type' => $time['type'], 'value' => date('Y-m-d H:i:s', strtotime('+1 second', $value))];
            case 'minute':
                return ['type' => $time['type'], 'value' => date('Y-m-d H:i', strtotime('+1 minute', $value))];
            case 'hour':
                return ['type' => $time['type'], 'value' => date('Y-m-d H', strtotime('+1 hour', $value)) . ":00"];
            case 'day':
                return ['type' => $time['type'], 'value' => date('Y-m-d', strtotime('+1 day', $value))];
            case 'month':
                return ['type' => $time['type'], 'value' => date('Y-m', strtotime('+1 month', $value))];
        }
        return null;
    }
}