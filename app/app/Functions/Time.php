<?php

namespace App\Functions;

use Carbon\Carbon;


class Time
{
    public static function getIntervalsInDay($minutes = 60)
    {
        if ($minutes <= 0) {
            return [];
        }

        for ($i = 0; $i < 24*60; $i += $minutes) {
            $hours[] = sprintf("%02d", floor($i / 60)) . ':' . sprintf("%02d", $i % 60);
        }

        return $hours;
    }

    public static function calculateTotalDaysInRange($startDate, $endDate, $startDay, $endDay)
    {
        $year = $startDate->year;
        $month = $startDate->month;
        $count = 0;

        for ($i = $startDate->day; $i <= $endDate->day; $i++) {
            $dt = Carbon::create($year, $month, $i);
            if ($dt->dayOfWeek >= $startDay && $dt->dayOfWeek <= $endDay) {
                $count += 1;
            }
        }
        return $count;
    }

    public static function createDateRange($startDate, $endDate, $format = 'Y-m-d')
    {
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end->add(new DateInterval('P1D'));

        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);

        $range = [];
        foreach ($dateRange as $date) {
            $range[] = $date->format($format);
        }
        return $range;
    }

    public static function millisecondsToDateFormat($milliseconds, $format = 'Y-m-d')
    {
        if (!is_numeric($milliseconds)) {
            return null;
        }

        $dateStr = Carbon::createFromTimestamp($milliseconds / 100);
        return $dateStr->format($format);
    }
}
