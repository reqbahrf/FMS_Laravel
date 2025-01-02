<?php 

namespace App\Actions;

use Exception;
use Carbon\Carbon;

class CalculateTimeAgo
{
    public static function execute($createdAt)
    {
        $timeUnits = [
            ['seconds' => 60, 'text' => 'Just now'],
            ['seconds' => 3600, 'method' => 'diffInMinutes', 'suffix' => ' min ago'],
            ['seconds' => 86400, 'method' => 'diffInHours', 'suffix' => ' hour ago'],
            ['seconds' => 604800, 'method' => 'diffInDays', 'suffix' => ' day ago'],
            ['seconds' => 2592000, 'method' => 'diffInWeeks', 'suffix' => ' week ago'],
            ['method' => 'diffInMonths', 'suffix' => ' month ago']
        ];

        $createdAt = Carbon::parse($createdAt);
        $now = Carbon::now();
        $diffInSeconds = $createdAt->diffInSeconds($now);

        $timeAgo = 'Just now';
        foreach ($timeUnits as $unit) {
            if (isset($unit['seconds']) && $diffInSeconds >= $unit['seconds']) {
                continue;
            }

            if (isset($unit['text'])) {
                $timeAgo = $unit['text'];
                break;
            }

            $method = $unit['method'];
            $value = round($createdAt->$method($now));
            $timeAgo = $value . $unit['suffix'];
            break;
        }

        return $timeAgo;
    }
}