<?php

use Carbon\CarbonImmutable;

function dates($month)
{
    // 月初の曜日(0[日]から6[土]の数値)
    $weekDay = date('w', strtotime($month));

    $dates = [];

    // 前月最終週の日付
    for (; $weekDay >= 1; $weekDay -= 1) {
        $dates[] = new CarbonImmutable("$month -$weekDay day");
    }

    // 月末日
    $lastDay = date('d', strtotime("last day of $month"));

    // その月の日付
    for ($day = 1; $day <= $lastDay; $day += 1) {
        $dates[] = new CarbonImmutable("$month-$day");
    }

    // 月末の曜日
    $weekDay = date('w', strtotime("$month-$lastDay"));

    // 来月最初の週の日付
    for ($day = 1; $day <= 6 - $weekDay; $day += 1) {
        $dates[] = new CarbonImmutable("$month-$lastDay +$day day");
    }

    return $dates;
}

function calendar($month)
{
    $dates = dates($month);

    for ($i = 0; $i < count($dates); $i += 7) {
        yield array_slice($dates, $i, 7);
    }
}
